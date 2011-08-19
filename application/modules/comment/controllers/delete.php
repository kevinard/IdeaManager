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
 * Description of delete
 *
 * @author mickael
 */

namespace application\modules\comment\controllers;

class delete extends \application\modules\user\securedZoneController
{

    protected $usesView = false;
    
    public function processAction($commentId = null)
    {
        if($commentId !== null)
        {
            $em = $this->getComponent('entityManager');
            $comment = $em->getRepository('\application\modules\comment\models\Comment')->find($commentId);
            
            if($comment !== null)
            {
                $em->remove($comment);
                $this->setMessage('Delete operation successfull');
            }
            else
            {
                $this->setMessage('No comment was found');
            }
            
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$comment->getUserRequest()->getId();
            $this->getComponent('httpResponse')->redirect($url, 302, false);
        }
    }

}