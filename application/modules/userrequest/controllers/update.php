<?php
namespace application\modules\userrequest\controllers;

class Update extends \application\modules\user\securedZoneController
{
	public function processAction($userRequestId = null)
	{\var_dump($_SESSION['connectedUser']->getId());
        $em = $this->getComponent('entityManager');
		
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

        $this->set('categories', $em->getRepository('\application\modules\category\models\Category')->findAll());
		// $this->set('category', $userrequest);
		$this->set('errors', array());

		// if (isset($_POST['updateUserrequest']))
		// {
        $errors = array_merge($this->checkTitle(), $this->checkContent(), $this->checkCatId());
        if (count($errors))
        {
            $this->set('errors', $errors);
            return;
        }
		
        $userrequest->setTitle($_POST['requestTitle']);
        $userrequest->setContent($_POST['requestContent']);
        $userrequest->setAuthor($em->getRepository('\application\modules\user\models\User')->find($_SESSION['connectedUser']->getId()));
        // $userrequest->setAuthor($_SESSION['connectedUser']);
        $userrequest->setCategory($em->getRepository('\application\modules\category\models\Category')->find($_POST['requestCategory']));


        if($userRequestId !== null && isset($_POST['requestState']))
        {
            $userrequest->setState($_POST['requestState']);
        }

        $em->persist($userrequest);
        $em->flush();
        
        $this->usesView = false;
        $url = $this->getConfig('siteUrl') . 'category/listing/';
        $this->getComponent('httpResponse')->redirect($url.$userrequest->getCategory()->getId(), 302, false);
		// }
	}

	private function checkTitle ()
	{
		if (!isset($_POST['requestTitle']) || $_POST['requestTitle'] == '')
		{
			$_POST['requestTitle'] = '';
			return array('title' => 'You must specify a title.');
		}
		return array();
	}

	private function checkContent ()
	{
		if (!isset($_POST['requestContent']) || $_POST['requestContent'] == '')
		{
			$_POST['requestContent'] = '';
			return array('requestContent' => 'You must specify a content.');
		}
		return array();
	}

	private function checkCatId ()
	{
		if (!isset($_POST['requestCategory']) || $_POST['requestCategory'] == '')
		{
			$_POST['requestCategory'] = '';
			return array('requestCategory' => 'You must specify a category.');
		}
		return array();
	}

}