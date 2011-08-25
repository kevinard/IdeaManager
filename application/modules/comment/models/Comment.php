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
 * Description of Comment
 *
 * @author mickael
 */

namespace application\modules\comment\models;

/**
 * @Entity 
 * @Table(name="comments")
 */
class Comment extends \framework\core\FrameworkObject
{
    
    /**
     * @var int The comment's id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    protected $id;
    
    /**
     * @var string The comment's content
     * @Column(type="text")
     */
    protected $content = '';
    
    /**
     * @var \application\modules\user\models\User The comment's owner
     * @ManyToOne(targetEntity="\application\modules\user\models\User", inversedBy="comments")
     */
    protected $user = null;

    /**
     * @var \application\modules\userrequest\models\UserRequest The UserRequest the comment is related to
     * @ManyToOne(targetEntity="\application\modules\userrequest\models\UserRequest", inversedBy="comments")
     */
    protected $userRequest = null;

    /**
     *
     * @var string The date when the comment was posted 
     */
    //protected $date;

        /**
     * Default constructor
     */
    public function __construct()
    {
        // empty
    }
    
    
    
    /**
     * GETTERS
     */

    /**
     * Get the comment's id
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the comment's content
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the comment's score (i.e. count its votes)
     * @return int 
     */
    public function getScore()
    {
        $em = $this->getComponent('entityManager');
        $votes = $em->getRepository('\application\modules\commentvote\models\CommentVote')
            ->findBy(array('comment' => $this->id));
        
        return count($votes);
        //return $this->score;
    }

    /**
     * Get the comment's owner
     * @return \application\modules\user\models\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the userRequest the comment is related to.
     * @return \application\modules\userrequest\models\UserRequest
     */
    public function getUserRequest()
    {
        return $this->userRequest;
    }


    
    /**
     * SETTERS
     */
    
    /**
     * Set the comment's content
     * @param string $content the new content
     * @return \application\modules\comment\models\Comment the current comment
     */
    public function setContent($content)
    {
        $this->content = strip_tags($content, '<a><p><span><ul><ol><li><em><i><strong><u><b><strike><div><blockquote>');
        //$this->content = $content;
        return $this;
    }

    /**
     * Set the comment's owner
     * @param \application\modules\user\models\User $user the new owner (User object)
     * @return \application\modules\comment\models\Comment the current comment
     */
    public function setUser(\application\modules\user\models\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Set the UserRequest the content is related to
     * @param \application\modules\userrequest\models\UserRequest $userRequest the new UserRequest
     * @return \application\modules\comment\models\Comment the current comment
     */
    public function setUserRequest(\application\modules\userrequest\models\UserRequest $userRequest)
    {
        $this->userRequest = $userRequest;
        return $this;
    }


    
}