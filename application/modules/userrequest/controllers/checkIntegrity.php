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
        $errors = array();
        
        // if there is nor new proposals nor old proposals conserved
        if(!isset($_POST['newProposals']) && !isset($_POST['oldProposals']))
        {
            $errors = array('userRequestProposals' => 'You must specify at least one proposal');
        }
        
        // if there are new proposals
        if (isset($_POST['newProposals']) && \is_array($_POST['newProposals']) 
            && \count($_POST['newProposals']) > 0)
		{
            // get rid of the empty ones
			foreach($_POST['newProposals'] as $key => $value)
            {
                if($value === '')
                {
                    unset($_POST['newProposals'][$key]);
                }
            }
            
            // then check if there is at least one proposal left
            if(\count($_POST['newProposals']) > 0)
                $errors = array();
            else
                $errors = array('userRequestProposals' => 'You must specify at least one proposal');
		}
        return $errors;
    }
    
    
}