<?php
namespace application\modules\category\controllers;

class GetChildrend extends \framework\core\Controller
{
    public function processAction($root_id)
    {
        //$this
        
        $all_categories = $this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->findBy(array('parent_id' => $cat_id));

        $this->set('categories', $categories);
    }
}
