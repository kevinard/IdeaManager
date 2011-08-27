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
 * Description of ProposalVote
 *
 * @author mickael
 */

namespace application\modules\vote\models;

/**
 * @Entity
 * @Table(name="proposalvotes")
 */
class ProposalVote extends \application\modules\vote\models\Vote
{

    /**
     * @ManyToOne(targetEntity="\application\modules\proposal\models\Proposal", cascade={"all"})
     * @var \application\modules\proposal\models\proposal The proposal the vote is related to.
     */
    protected $proposal = null;
    
    public function __construct()
    {
        // empty
    }

    /**
     * GETTERS
     */
    
    /**
     * Get the proposal the vote is related to.
     * @return \application\modules\proposal\models\Proposal 
     */
    public function getProposal()
    {
        return $this->proposal;
    }
    

    /**
     * SETTERS
     */
    
    /**
     * Set the proposal the vote is related to.
     * @param \application\modules\proposal\models\Proposal $proposal The new Proposal
     * @return \application\modules\vote\models\ProposalVote the current vote
     */
    public function setProposal(\application\modules\proposal\models\Proposal $proposal)
    {
        $this->proposal = $proposal;
        return $this;
    }




}