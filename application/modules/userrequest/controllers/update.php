<?php

/**
 * @TODO: split the controller in 2 parts : one for the actual update and the other for the creation
 */
namespace application\modules\userrequest\controllers;

class Update extends \application\modules\user\securedZoneController
{
	public function processAction($userRequestId = null)
	{
        $em = $this->getComponent('entityManager');
        
        $userRequest = $em->getRepository('\application\modules\userrequest\models\UserRequest')->find($userRequestId);
        
        // if UserRequest was found, redirect 
        if ($userRequest === null)
        {
            $this->usesView = false;
            $this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302, false);
        }
		else
        {
            // get all the proposals related to this UserRequest
            $newProposals = $em->getRepository('\application\modules\proposal\models\Proposal')
                ->findBy(array('userRequest' => $userRequestId), 'content');
            
            // send the catagories and the proposals to the view
            $this->set('categories', $em->getRepository('\application\modules\category\models\Category')->findAll());
            $this->set('proposals', $newProposals);
        }
        
        
        // if modifications have been made
        if(isset($_POST['formSubmit']))
        {
            // check for errors or missing fields
            $this->set('errors', array());
            $errors = $this->createRequest('userrequest', 'checkIntegrity')->execute()->get();
            
            if (count($errors))
            {
                $this->set('errors', $errors);
                return;
            }
            else
            {
                // set the title, content, author, category and state
                $userRequest->setTitle($_POST['userRequestTitle']);
                $userRequest->setContent($_POST['userRequestContent']);
                $userRequest->setAuthor($em->getRepository('\application\modules\user\models\User')->find($_SESSION['connectedUser']->getId()));
                $userRequest->setCategory($em->getRepository('\application\modules\category\models\Category')->find($_POST['userRequestCategory']));
                $userRequest->setState($_POST['userRequestState']);

                
                // get and remove the old proposals
                $oldProposals = $em->getRepository('\application\modules\proposal\models\Proposal')
                    ->findBy(array('userRequest' => $userRequestId));
                
                foreach($oldProposals as $proposal)
                {
                    $em->remove($proposal);
                }
                
                // set the new proposals
                $newProposals = array();
                foreach($_POST['userRequestProposals'] as $content)
                {
                    $newProposals[] = new \application\modules\proposal\models\Proposal($content, $userRequest);
                }

                // persist the objects in the database
                $em->persist($userRequest);

                foreach($newProposals as $proposal)
                {
                    $em->persist($proposal);
                }

                $em->flush();

                // redirection
                $this->usesView = false;
                $url = $this->getConfig('siteUrl') . 'userrequest/read/';
                $this->getComponent('httpResponse')->redirect($url.$userRequest->getId(), 302, false);
            }
        }
        else
        {
            $this->set('userRequest', $userRequest);
        }
        
	}
}