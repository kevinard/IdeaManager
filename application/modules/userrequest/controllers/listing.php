<?php
namespace application\modules\userrequest\controllers;

class Listing extends \framework\core\Controller
{
    public function processAction($catId = null, $state = null)
    {
        $criteria = array();
		
		if ($catId !== null)
		{
			$criteria['category'] = $catId;
		}
		if ($state !== null)
		{
			$criteria['state'] = $state;
		}
		
		$userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findBy($criteria);

        $this->set('userrequests', $userrequests);
    }
}