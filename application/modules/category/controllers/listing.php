<?php
namespace application\modules\category\controllers;

class Listing extends \framework\core\Controller
{
    public function processAction($parent_id = 1)
    {
        $categories = $this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->findByParentId($parent_id);

        $this->set('categories', $categories);
    }
}