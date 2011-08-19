<?php
namespace application\modules\userrequest\controllers;

class GetNumber extends \framework\core\Controller
{
    public function processAction($catId = null)
    {
        if ($catId === null)
		{
			$catId = '*';
		}
		
		$userrequests = count($this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findByCategory($catId));

        $this->getResponse()->set($userrequests);
    }
}