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
                
                // persist the modified UserRequest in the database
                $em->persist($userRequest);
                
                
                /**
                 * dans les proposals qui existaient déjà et qui ont été conservées : $_POST['oldProposals']
                 *      - changer le contenu si nécessaire
                 * dans les nouvelles proposals : $_POST['newProposals']
                 *      - ajouter à la base de données
                 * dans les proposals à supprimer : $_POST['obsoleteProposals']
                 *      - supprimer de la base de données
                 *      - supprimer les votes liés
                 */
                
                // deal with the old proposals
                if(isset($_POST['oldProposals']))
                {
                    // get the old proposals we want to keep
                    $oldProposals = array();
                    foreach($_POST['oldProposals'] as $id => $content)
                    {
                        $prop = $em->getRepository('\application\modules\proposal\models\Proposal')->find($id);
                        $prop->setContent($content);
                        $oldProposals[] = $prop;
                    }
                    
                    // persist the old proposals
                    foreach($oldProposals as $old)
                    {
                        $em->persist($old);
                    }
                }
                
                // deal with the new proposals
                if(isset($_POST['newProposals']))
                {
                    // get the new proposals we want to add
                    $newProposals = array();
                    foreach($_POST['newProposals'] as $content)
                    {
                        $newProposals[] = new \application\modules\proposal\models\Proposal($content, $userRequest);
                    }
                    
                    // persist the new proposals
                    foreach($newProposals as $new)
                    {
                        $em->persist($new);
                    }
                }
                
                
                // deal with the obsolete proposals
                if(isset($_POST['obsoleteProposals']))
                {
                    // get the obsolete proposals we want to remove, and their related votes
                    $obsoleteProposals = array();
                    $obsoleteVotes = array();
                    foreach($_POST['obsoleteProposals'] as $id)
                    {
                        $obsoleteProposals[] = $em->getRepository('\application\modules\proposal\models\Proposal')->find($id);
                        
                        $relatedVotes = $em->getRepository('\application\modules\vote\models\ProposalVote')->findBy(array('proposal' => $id));
                        foreach($relatedVotes as $vote)
                        {
                            $obsoleteVotes[] = $vote;
                        }
                    }
                    
                    // remove the old votes
                    foreach($obsoleteVotes as $obsolete)
                    {
                        $em->remove($obsolete);
                    }
                    
                    // remove the obsolete proposals
                    foreach($obsoleteProposals as $obsolete)
                    {
                        $em->remove($obsolete);
                    }

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