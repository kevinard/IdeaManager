<?php

namespace application\modules\userrequest\models;

/**
 * @Entity @Table(name="userrequests")
 */
class UserRequest
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @Column(type="string")
     */
    protected $title;
    /**
     * @Column(type="text")
     */
    protected $content;
    /**
     * @OneToMany(targetEntity="\application\modules\user\models\User", inversedBy="userrequests", cascade={"persist"})
     */
    protected $author;
    /**
     * @Column(type="datetime")
	 * @var DateTime
     */
    protected $date;
     /**
     * @ManyToOne(targetEntity="\application\modules\category\models\Category", cascade={"remove"})
     */
    protected $category;
    
    /**
     * @Column(type="integer")
     */
    protected $state;

    const STATE_NEW = 0;
    const STATE_ACCEPTED = 1;
    const STATE_REFUSED = -1;
    const STATE_LATER = 2;
    
    public function __construct ()
    {
        $this->state = self::STATE_NEW;
    }

    /****************/
    /*	Getter ID   */
    /****************/

    public function getId ()
    {
        return $this->id;
    }

    /*************************/
    /*	Getter/Setter TITLE  */
    /*************************/
    public function getTitle ()
    {
        return $this->title;
    }

    public function setTitle ($title)
    {
        $this->title = strval($title);
        return $this;
    }

    /***************************/
    /*	Getter/Setter CONTENT  */
    /***************************/
    public function getContent ()
    {
        return $this->content;
    }

    public function setContent ($content)
    {
        $this->content = strval($content);
        return $this;
    }

    /*****************************/
    /*	Getter/Setter AUTHOR_ID  */
    /*****************************/

    public function getAuthor ()
    {
        return $this->author;
    }

    public function setAuthor ($author)
    {
        $this->author = $author;
        return $this;
    }

    /*************************/
    /*	Getter/Setter DATE   */
    /*************************/

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /****************************/
    /*	Getter/Setter CAT_ID    */
    /****************************/

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory ($category)
    {
        $this->category = $category;
        return $this;
    }

    /*************************/
    /*	Getter/Setter STATE  */
    /*************************/
    public function getState ()
    {
        return $this->state;
    }

    public function setState ($state)
    {
        $this->state = intval($state);
        return $this;
    }

}
