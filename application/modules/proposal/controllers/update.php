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

namespace application\modules\proposal\controllers;

class update extends \application\modules\user\securedZoneController
{

    public function processAction($proposalId = null)
    {
        $em = $this->getComponent('entityManager');
        
        if($proposalId === null)
        {
            $proposal = new \application\modules\proposal\models\Proposal();
        }
        else
        {
            $proposal = $em->getRepository('\application\modules\proposal\models\Proposal')->find($proposalId);
        }
        
        if($proposal !== null && isset($_POST['proposalContent']) && isset($_POST['proposalUserRequest']))
        {
            $proposal->setContent($_POST['proposalContent']);
            $proposal->setUserRequest($em->getRepository('\application\modules\userrequest\models\UserRequest')->find($_POST['proposalUserRequest']));
            
            $em->presist($proposal);
            
            // $this->set('proposal', $proposal);
            
            $url = $this->getConfig('siteUrl').'userRequest/';
            $this->getComponent('httpResponse')->redirect($url.'read/'.$proposal->getUserrequest()->getId(), 302, false);
        }
        else
        {
            $this->getComponent('httpResponse')->redirect($url.'listing', 302, false);
        }
    }

}