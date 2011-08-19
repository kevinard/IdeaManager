<?php
namespace application\modules\category\controllers;

class Create extends \framework\core\Controller
{
    protected $usesView = false;

    public function processAction()
    {
        $this->setResponse($this->createRequest('category', 'update')->execute());
    }
}