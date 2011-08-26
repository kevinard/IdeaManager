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
 * Controller checkIntegrity
 *
 * @author mickael
 */

namespace application\modules\userrequest\controllers;

class checkIntegrity extends \framework\core\Controller
{
    protected $usesView = false; 
    protected $isInternal = true;

    public function processAction()
    {
        // $this->isInternal = true;
        
        $this->getResponse()->set(\array_merge($this->checkTitle(), 
            $this->checkContent(), $this->checkCatId(), $this->checkProposals()));
    }

    
    /**
     * PRIVATE FUNCTIONS
     */
    
    
	private function checkTitle ()
	{
		if (!isset($_POST['userRequestTitle']) || $_POST['userRequestTitle'] == '')
		{
			$_POST['userRequestTitle'] = '';
			return array('title' => 'You must specify a title.');
		}
		return array();
	}

	private function checkContent ()
	{
		if (!isset($_POST['userRequestContent']) || $_POST['userRequestContent'] == '')
		{
			$_POST['userRequestContent'] = '';
			return array('userRequestContent' => 'You must specify a content.');
		}
		return array();
	}

	private function checkCatId ()
	{
		if (!isset($_POST['userRequestCategory']) || $_POST['userRequestCategory'] == '')
		{
			$_POST['userRequestCategory'] = '';
			return array('userRequestCategory' => 'You must specify a category.');
		}
		return array();
	}
    
    private function checkProposals()
    {
        if (isset($_POST['userRequestProposals']) && \is_array($_POST['userRequestProposals']) 
            && count($_POST['userRequestProposals']) > 0)
		{
			foreach($_POST['userRequestProposals'] as $key => $value)
            {
                if($value === '')
                {
                    unset($_POST['userRequestProposals'][$key]);
                }
            }
            
            if(count($_POST['userRequestProposals']) > 0)
                return array();
		}
        
        return array('userRequestProposals' => 'You must specify at least one proposal'); 
        
    }
    
    
}