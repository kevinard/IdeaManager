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
    * The UserRequest the proposal is related to 
    * @var \application\modules\userrequest\models\UserRequest 
    * @ManyToOne(targetEntity="\application\modules\userrequest\models\UserRequest", inversedBy="proposals" )
    */
    protected $userRequest = null;
    
    
    
    
    /**
     * Constructor
     * @param string $content The proposal's content
     * @param \application\modules\userrequest\models\UserRequest $userRequest The proposal's UserRequest
     */
    public function __construct($content = null, \application\modules\userrequest\models\UserRequest $userRequest = null)
    {
        if($content !== null)
            $this->setContent($content);
    
        if($userRequest !== null)
            $this->setUserRequest($userRequest);
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
     * @return \application\modules\userrequest\models\UserRequest 
     */
    public function getUserRequest()
    {
        return $this->userRequest;
    }

    /**
     * Get the proposal's score (i.e. count its votes)
     * @return int The score
     */
    public function getScore()
    {
        $em = $this->getComponent('entityManager');
        
        $votes = $em->getRepository('\application\modules\vote\models\ProposalVote')
            ->findBy(array('proposal' => $this->id));
        
        return count($votes);
    }
    

    /**
     * SETTERS
     */
    
    /**
     * Set the proposal's content.
     * @param string $content The new content
     * @return \application\modules\proposal\models\Proposal 
     */
    public function setContent($content)
    {
        $this->content = strip_tags($content, '<a><p><span><ul><ol><li><em><i><strong><u><b><strike><div><blockquote>');
        return $this;
    }

    /**
     * Set the UserRequest the proposal is related to.
     * @param int $userRequest
     * @return \application\modules\proposal\models\Proposal 
     */
    public function setUserRequest(\application\modules\userrequest\models\UserRequest $userRequest)
    {
        $this->userRequest = $userRequest;
        return $this;
    }


}

