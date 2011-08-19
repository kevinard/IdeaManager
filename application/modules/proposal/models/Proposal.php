<?php
/**
 * Description of proposal
 *
 * @author mickael
 */



namespace application\modules\proposal\models;


/**
 * @Entity 
 * @Table(name="proposals")
 */
class Proposal extends \framework\core\FrameworkObject
{
    /**
     * @var int The proposal'id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    protected $id;
    
    /**
     * @var string The proposal's content
     * @Column(type="text")
     */
    protected $content = '';
    
    /**
     * @var \application\modules\userRequest\models\UserRequest The UserRequest the proposal is related to
	 * @ManyToOne(targetEntity="\application\modules\userRequest\models\UserRequest", inversedBy="proposals")
	 */
    protected $userRequest = null;
    
    
    
    
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
     * Get the proposal's id
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the proposal's content
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the UserRequest the proposal is related to
     * @return \application\modules\userRequest\models\UserRequest 
     */
    public function getUserRequest()
    {
        return $this->userRequest;
    }


    /**
     * SETTERS
     */
    
    /**
     * Set the proposal's content.
     * @param string $content The new content
     * @return \application\modules\proposal\models\Proposal 
     */
    public function setContent(string $content)
    {
        $this->content = strip_tags($content, '<a><p><span><ul><ol><li><em><i><strong><u><b><strike><div><blockquote>');
        return $this;
    }

    /**
     * Set the UserRequest the proposal is related to.
     * @param int $userRequest
     * @return \application\modules\proposal\models\Proposal 
     */
    public function setUserRequest(int $userRequest)
    {
        $this->userRequest = $userRequest;
        return $this;
    }


}

