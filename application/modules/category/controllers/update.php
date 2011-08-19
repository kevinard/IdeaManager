<?php

namespace application\modules\category\controllers;

class Update extends \framework\core\Controller
{

    public function processAction($category_id = null)
    {
        $url = $this->getConfig("siteUrl") . "category/listing";

        if($category_id === null)
        {
            $category = new \application\modules\category\models\Category();
        }
        else
        {
            $category = $this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->find($category_id);
            if(!$category)
            {
                $this->usesView = false;
                $this->getComponent("httpResponse")->redirect($url, 302, false);
            }
        }

        $categories = $this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->findAll();
        $this->set('categories', $categories);

        $this->set('category', $category);
        $this->set('errors', array());


        $errors = array_merge($this->checkName(), $this->checkParentId());

        if(count($errors))
        {
            $this->set('errors', $errors);
            return;
        }

        $category->setName($_POST['name']);
        $category->setParentId($this->getComponent('entityManager')->getRepository('application\modules\category\models\Category')->find($_POST['parentId']));

        $this->getComponent('entityManager')->persist($category);
        
        //$this->getComponent('entityManager')->flush();
        
        $this->usesView = false;
        $this->getComponent("httpResponse")->redirect($url, 302, false);
    }

    private function checkName()
    {
        if(!isset($_POST['name']) || $_POST['name'] == "")
        {
            $_POST['name'] = '';
            return array("name" => "You must specify a name.");
        }
        return array();
    }

    private function checkParentId()
    {
        if(!isset($_POST['parentId']) || $_POST['parentId'] == '')
        {
            $_POST['parentId'] = '';
            return array("parentId" => "You must specify a parent category.");
        }
        return array();
    }

}