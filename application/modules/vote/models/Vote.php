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
 * Description of Vote
 *
 * @author mickael
 */

namespace application\modules\vote\models;

/**
 * @MappedSuperClass
 */
abstract class Vote extends \framework\core\FrameworkObject
{
    
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int The vote's id 
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="\application\modules\user\models\User", cascade={"remove"})
     * @var \application\modules\user\models\User The owner of the comment 
     */
    protected $user = null;
    
    
    public function __construct()
    {
        // empty
    }

    
    
    /**
     * GETTERS
     */
    
    /**
     * Get the vote's id
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the vote's owner
     * @return \application\modules\user\models\User
     */
    public function getUser()
    {
        return $this->user;
    }


    
    /**
     * SETTERS
     */
    
    /**
     * Set the owner of the vote
     * @param \application\modules\user\models\User $user The new owner
     * @return \application\modules\vote\models\Vote The current vote
     */
    public function setUser(\application\modules\user\models\User $user)
    {
        $this->user = $user;
        return $this;
    }


}