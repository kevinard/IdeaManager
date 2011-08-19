<?php
namespace application\modules\userrequest\controllers;

class GetUserRequests extends \framework\core\Controller
{
    protected $usesView = false;

	public function processAction($catId)
    {
		$userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findByCategory($catId);

        $this->getResponse()->set($userrequests);
    }
}