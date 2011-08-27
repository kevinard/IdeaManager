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

/* @var $vote       \application\modules\vote\models\Vote */
/* @var $comment    \application\modules\comment\models\Comment */
/* @var $user       \application\modules\user\models\User */
/* @var $url        string */

namespace application\modules\comment\controllers;

class vote extends \application\modules\user\securedZoneController
{
    protected $usesView = false;

    public function processAction($commentId = null)
    {
        if($commentId !== null)
        {
            $em = $this->getComponent('entityManager');
            
            // check if the user hasn't already voted for that comment
            $vote = $em->getRepository('\application\modules\vote\models\CommentVote')
                ->findBy(array('user' => $_SESSION['connectedUser']->getId(), 'comment' => $commentId));
            
            $comment = $em->getRepository('\application\modules\comment\models\Comment')
                ->find($commentId);
            
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$comment->getUserRequest()->getId();
            
            if(count($vote) === 0)
            {
                $vote = new \application\modules\vote\models\CommentVote();
                
                $user = $em->getRepository('\application\modules\user\models\User')
                    ->find($_SESSION['connectedUser']->getId());
                
                $vote->setComment($comment);
                $vote->setUser($user);
                
                $em->persist($vote);
                //$em->flush();
            }
            else
            {
                $this->setMessage('You already voted for this comment');    
            }
            
            $this->getComponent('httpResponse')->redirect($url, 302, false);
        }
        else
        {
            $this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302, false);
        }
    }

}