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
 * Description of CommentVote
 *
 * @author mickael
 */

namespace application\modules\vote\models;

/**
 * @Entity
 * @Table(name="commentvotes")
 */
class CommentVote extends \application\modules\vote\models\Vote
{

    /**
     * @ManyToOne(targetEntity="\application\modules\comment\models\Comment", cascade={"all"})
     * @var \application\modules\comment\models\Comment The comment the vote is related to. 
     */
    protected $comment = null;
    
    public function __construct()
    {
        // empty
    }
    
    /**
     * GETTERS
     */

    /**
     * Get the comment the vote is related to.
     * @return \application\modules\comment\models\Comment 
     */
    public function getComment()
    {
        return $this->comment;
    }

    
    /**
     * SETTERS
     */
    
    /**
     * Set the comment the vote is related to.
     * @param \application\modules\comment\models\Comment $comment The new comment
     * @return \application\modules\vote\models\CommentVote the current vot
     */
    public function setComment(\application\modules\comment\models\Comment $comment)
    {
        $this->comment = $comment;
        return $this;
    }


}