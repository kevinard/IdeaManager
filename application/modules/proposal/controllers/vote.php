<?php

/*
 * Copyright (C) 2011 - Kévin O'NEILL, François KLINGLER - <contact@42framework.com>
 * 
 * 42framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * 42framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 */


/**
 * Controller vote
 *
 * @author mickael
 */

/* @var $proposal   \application\modules\proposal\models\Proposal */
/* @var $vote       \application\modules\proposalvote\models\ProposalVote */
/* @var $url        string */

namespace application\modules\proposal\controllers;

class vote extends \application\modules\user\securedZoneController
{
    protected $usesView = false;

    public function processAction($proposalId = null)
    {
        if($proposalId !== null)
        {
            $em = $this->getComponent('entityManager');
            
            // check if the user hasn't already voted for that proposal
            $vote = $em->getRepository('\application\modules\proposalvote\models\ProposalVote')
                ->findBy(array('user' => $_SESSION['connectedUser']->getId(), 'proposal' => $proposalId));
            
            $proposal = $em->getRepository('\application\modules\proposal\models\Proposal')
                ->find($proposalId);
            
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$proposal->getUserRequest()->getId();
            
            if(count($vote) === 0)
            {
                $vote = new \application\modules\proposalvote\models\ProposalVote();
                
                $user = $em->getRepository('\application\modules\user\models\User')
                    ->find($_SESSION['connectedUser']->getId());
                
                $vote->setProposal($proposal);
                $vote->setUser($user);
                
                $em->persist($vote);
                //$em->flush();
            }
            else
            {
                $this->setMessage('You already voted for this proposal');    
            }
            
            $this->getComponent('httpResponse')->redirect($url, 302, false);
        }
        else
        {
            $this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302, false);
        }
    }

}