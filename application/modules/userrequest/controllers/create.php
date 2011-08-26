<?php
namespace application\modules\userrequest\controllers;

class Create extends \application\modules\user\securedZoneController
{

    public function processAction()
    {
        $em = $this->getComponent('entityManager');
        
        // get all the categories and send them to the view
        $this->set('categories', $em->getRepository('\application\modules\category\models\Category')->findAll());
        
        if(isset($_POST['formSubmit']))
        {
            $userRequest = new \application\modules\userrequest\models\UserRequest();
            
            // check for errors or missing fields
            $this->set('errors', array());
            $errors = $this->createRequest('userrequest', 'checkIntegrity')->execute()->get();
            
            if (count($errors))
            {
                $this->set('errors', $errors);
                var_dump($errors);
                exit;
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

                // set the proposals
                $proposals = array();
                foreach($_POST['userRequestProposals'] as $content)
                {
                    $proposals[] = new \application\modules\proposal\models\Proposal($content, $userRequest);
                }

                // persist the objects in the database
                $em->persist($userRequest);

                foreach($proposals as $proposal)
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
    }
}