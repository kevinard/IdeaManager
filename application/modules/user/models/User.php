<?php
namespace application\modules\user\models;

/**
 * @Entity 
 * @Table(name="users", uniqueConstraints={@UniqueConstraint(name="login_unique_constraint", columns={"login"})})
 */
class User extends \framework\core\FrameworkObject
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;
    /**
     * @Column(type="string")
     */
    protected $login;
    /**
     * @Column(type="string", length="128")
     * Password is stored as a hash, represented as a 128 bytes length string.
     * This length is required by hash("sha512")
     */
    protected $password;
    /**
     * @Column(type="integer")
     */
    protected $level;
    const ADMIN = 1;
    const USER = 0;

    public function __construct()
    {
    }

    /************************/
    /*	Getter/Setter ID	*/
    /************************/	
	
    public function getId()
    {
        return $this->id;
    }
	
    /************************/
    /*	Getter/Setter LOGIN	*/
    /************************/	
	
    public function getLogin()
    {
        return $this->login;
    }
	
    public function setLogin($login)
    {
        if (strlen($login) > 0)
        {
            $this->login = strval($login);
        }
    }
	
    /****************************/
    /*	Getter/Setter PASSWORD	*/
    /****************************/	
	
    public function getPassword()
    {
        return $this->password;
    }
	
    public function setPassword($password)
    {
		$this->password = hash("sha512", $this->getConfig('securitySalt').$password);
    }
	
    /************************/
    /*	Getter/Setter LEVEL	*/
    /************************/	
	
    public function getLevel()
    {
        return $this->level;
    }
	
    public function setLevel($level)
    {
        if ($level == User::ADMIN || $level == User::USER)
        {
            $this->level = $level;
        }
    }
	
	public function isAdmin()
	{
		if ($this->level == User::ADMIN)
        {
            return true;
        }
		return false;
	}
    
    public function __toString()
    {
        return $this->login;    
    }

}

