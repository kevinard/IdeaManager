<?php
namespace application\modules\userrequest\controllers;

class Update extends \application\modules\user\securedZoneController
{
	public function processAction($userRequestId = null)
	{\var_dump($_SESSION['connectedUser']->getId());
        $em = $this->getComponent('entityManager');
		
        // create a new UserRequest or get the one which has the specified ID
        if ($userRequestId === null)
		{
			$userrequest = new \application\modules\userrequest\models\UserRequest();
            $userrequest->setDate(new \DateTime('now'));
            $this->set('newRequest', true);
		}
		else
		{
			$userrequest = $em->getRepository('application\modules\category\models\Category')->find($userRequestId);
			$this->set('newRequest', false);
            if (!$userrequest)
			{
				$this->usesView = false;
				$this->getComponent('httpResponse')->redirect($url, 302, false);
			}
		}

        // get all the categories
        $this->set('categories', $em->getRepository('\application\modules\category\models\Category')->findAll());

		// check for errors or missing fields
        $this->set('errors', array());
        $errors = array_merge($this->checkTitle(), $this->checkContent(), $this->checkCatId(), $this->checkProposals());
        if (count($errors))
        {
            $this->set('errors', $errors);
            return;
        }
		
        // set the title, content, author, category and state
        $userrequest->setTitle($_POST['userRequestTitle']);
        $userrequest->setContent($_POST['userRequestContent']);
        $userrequest->setAuthor($em->getRepository('\application\modules\user\models\User')->find($_SESSION['connectedUser']->getId()));
        $userrequest->setCategory($em->getRepository('\application\modules\category\models\Category')->find($_POST['userRequestCategory']));
        $userrequest->setState($_POST['userRequestState']);
        
        // set the proposals
        $proposals = array();
        foreach($_POST['userRequestProposals'] as $content)
        {
            $proposals[] = new \application\modules\proposal\models\Proposal($content, $userrequest);
        }
        
        // persist the objects in the database
        $em->persist($userrequest);
        
        foreach($proposals as $proposal)
        {
            $em->persist($proposal);
        }
        
        $em->flush();

        // redirection
        $this->usesView = false;
        $url = $this->getConfig('siteUrl') . 'userrequest/read/';
        $this->getComponent('httpResponse')->redirect($url.$userrequest->getId(), 302, false);
	}

    
    
    
    /**
     * PRIVATE FUNCTIONS
     */
    
    
	private function checkTitle ()
	{
		if (!isset($_POST['userRequestTitle']) || $_POST['userRequestTitle'] == '')
		{
			$_POST['userRequestTitle'] = '';
			return array('title' => 'You must specify a title.');
		}
		return array();
	}

	private function checkContent ()
	{
		if (!isset($_POST['userRequestContent']) || $_POST['userRequestContent'] == '')
		{
			$_POST['userRequestContent'] = '';
			return array('userRequestContent' => 'You must specify a content.');
		}
		return array();
	}

	private function checkCatId ()
	{
		if (!isset($_POST['userRequestCategory']) || $_POST['userRequestCategory'] == '')
		{
			$_POST['userRequestCategory'] = '';
			return array('userRequestCategory' => 'You must specify a category.');
		}
		return array();
	}
    
    private function checkProposals()
    {
        if (isset($_POST['userRequestProposals']) && \is_array($_POST['userRequestProposals']) 
            && count($_POST['userRequestProposals']) > 0)
		{
			foreach($_POST['userRequestProposals'] as $key => $value)
            {
                if($value === '')
                {
                    unset($_POST['userRequestProposals'][$key]);
                }
            }
            
            if(count($_POST['userRequestProposals']) > 0)
                return array();
		}
        
        return array('userRequestProposals' => 'You must specify at least one proposal'); 
        
    }

}