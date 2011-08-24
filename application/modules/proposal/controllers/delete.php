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

namespace application\modules\proposal\controllers;

class delete extends \application\modules\user\securedZoneController
{

    //public $usesView = false;
    
    public function processAction($proposalId = null)
    {
        if($proposalId !== null)
        {
            $em = $this->getComponent('entityManager');
            $proposal = $em->getRepository('application\modules\proposal\models\Proposal')->find($proposalId);
            
            if($proposal !== null)
            {
                $em->remove($proposal);
                $em->flush();
                $this->setMessage('Delete action successful');
            }
            else
            {
                $this->setMessage('No proposal was found');
            }
            
            $url = $this->getConfig('siteUrl').'userrequest/read/'.$proposal->getUserRequest()->getId();
            $this->getComponent('httpResponse')->redirect($url, 302, false);
        }
    }

}