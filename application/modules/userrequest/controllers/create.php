<?php
namespace application\modules\userrequest\controllers;

class Create extends \application\modules\user\securedZoneController
{
    protected $usesView = false;

    public function processAction()
    {
        $this->setResponse($this->createRequest('userrequest', 'update')->execute());
    }
}