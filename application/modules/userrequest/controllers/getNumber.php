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
		
		$userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->countByCategory($catId);

        $this->getResponse()->set($userrequests);
    }
}