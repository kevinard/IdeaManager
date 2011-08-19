<?php
namespace application\modules\userrequest\controllers;

class GetNumber extends \framework\core\Controller
{
    protected $usesView = false;

	public function processAction($catId = null)
    {
        $this->setLayout(false);
		
		if ($catId !== null)
		{
			$userrequests = count($this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findByCategory($catId));
		}
		else
		{
			$userrequests = count($this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findAll());
		}
		
		$this->getResponse()->set($userrequests);
    }
}