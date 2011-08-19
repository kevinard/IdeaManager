<?php
namespace application\modules\userrequest\controllers;

class Listing extends \framework\core\Controller
{
    public function processAction($catId = null, $state = null)
    {
        if ($catId === null)
		{
			$catId = '*';
		}
		if ($state === null)
		{
			$state = '*';
		}
		
		$userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findBy(array('category' => $catId, 'state' => $state));

        $this->set('userrequests', $userrequests);
    }
}