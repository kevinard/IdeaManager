<?php
namespace application\modules\category\controllers;

class Listing extends \framework\core\Controller
{
    public function processAction($parent_id = 1)
    {
        $categories = $this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->findByParentId($parent_id);
		$userrequests = $this->createRequest('userrequest', 'listing', array($parent_id))->execute()->get();
		
        $this->set('categories', $categories);
		$this->set('userrequests', $userrequests);
    }
}