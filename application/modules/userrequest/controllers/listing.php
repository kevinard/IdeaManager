<?php
namespace application\modules\userrequest\controllers;

class Listing extends \framework\core\Controller
{
    public function processAction($state = null)
    {
        $userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->findBy(array('state' => $state));

        $this->set('userrequests', $userrequests);
    }
}