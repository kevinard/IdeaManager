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
 * Description of update
 *
 * @author mickael
 */

namespace application\modules\comment\controllers;

class update extends \application\modules\user\securedZoneController
{
    public $usesView = false;

    public function processAction($commentId)
    {
        $em = $this->getComponent('entityManager');
        
        if($commentId !== null)
        {
            $comment = new \application\modules\comment\models\Comment();
        }
        else
        {
            $comment = $em->getRepository('\application\modules\userrequest\models\UserRequest')->find($commentId);
        }
        
        
        if($comment !== null && isset($_POST['commentContent']) 
            && isset($_POST['userId']) && isset($_POST['userRequestId']))
        {
            $comment->setContent($_POST['commentContent']);
            $comment->setUser($em->getRepository('\application\modules\user\models\User')->find($_SESSION['connectedUser']->getId()));
            $comment->setUserRequest($em->getRepository('\application\modules\userrequest\models\UserRequest')->find($_POST['userRequestId']));
            
            $em->persist($comment);

            // $this->set('comment', $comment);
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$comment->getUserRequest()->getId();
            $this->getComponent('httpResponse')->redirect($url , 302, false);
        }
        
    }

}