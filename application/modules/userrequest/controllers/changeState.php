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
 * Controller changeState
 *
 * @author mickael
 */

namespace application\modules\userrequest\controllers;

class changeState extends \application\modules\user\securedZoneController
{
    protected $usesView = false;
    protected $isInternal = true;
    
    public function processAction($userRequestId = null, $state = \application\modules\userrequest\models\UserRequest::STATE_NEW)
    {
        /* @var $userRequest \application\modules\userrequest\models\UserRequest */
        
        if($userRequestId !== null)
        {
            $em = $this->getComponent('entityManager');
            $userRequest = $em->getRepository('\application\modules\userrequest\models\UserRequest')
                ->find($userRequestId);
            
            $userRequest->setState($state);
            
            $em->persist($userRequest);
            
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$userRequestId;
            $this->getComponent('httpResponse')->redirect($url, 302, false);
        }
        else
        {
            $this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302, false);
        }
    }


}