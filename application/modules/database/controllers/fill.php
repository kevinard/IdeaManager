<?php
namespace application\modules\database\controllers;

class Fill extends \framework\core\Controller
{
	protected $usesView = false;

	public function processAction()
	{
		$em = $this->getComponent('entityManager');

		$user1 = new \application\modules\user\models\User();
		$user1->setLogin("admin");
		$user1->setPassword("password");
		$user1->setLevel(1);
		$em->persist($user1);
		
		$user2 = new \application\modules\user\models\User();
		$user2->setLogin("mitch");
		$user2->setPassword("azerty");
		$user2->setLevel(1);
		$em->persist($user2);
		
		$user3 = new \application\modules\user\models\User();
		$user3->setLogin("ghz");
		$user3->setPassword("aa");
		$user3->setLevel(1);
		$em->persist($user3);
        
        $root = new \application\modules\category\models\Category();
		$root->setName('root');
		$root->setParentId(null);
		$em->persist($root);
	}
}

