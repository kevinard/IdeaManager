<?php

namespace application\modules\category\models;

/**
 * @Entity @Table(name="categories")
 */
class Category
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @Column(type="string")
     */
    
    protected $name;
    
    /**
     * @OneToMany(targetEntity="Category", mappedBy="parentId", cascade={"remove"})
     */
    protected $subCategories;
    
    /**
     * @ManyToOne(targetEntity="Category", inversedBy="subCategories")
     */
    protected $parentId;
	
    public function __construct ()
    {
        $this->subCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /****************/
    /*	Getter ID   */
    /****************/

    public function getId ()
    {
        return $this->id;
    }

    /************************/
    /*	Getter/Setter NAME  */
    /************************/

    public function getName ()
    {
        return $this->name;
    }

    public function setName ($name)
    {
        $this->name = strval($name);
    }

    /****************************/
    /*	Getter/Setter PARENT ID	*/
    /****************************/

    public function getParentId ()
    {
        return $this->parentId;
    }

    public function setParentId ($parentId)
    {
        $this->parentId = $parentId;
    }


    /***************************/
    /*	Getter SUB CATEGORIES  */
    /***************************/

    public function getSubCategories()
    {
        return $this->subCategories;
    }
    
    public function setSubCategories($subCategories)
    {
        $this->subCategories = $subCategories;
    }

}
