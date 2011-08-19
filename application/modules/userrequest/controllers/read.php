<?php
namespace application\modules\userrequest\controllers;

class Read extends \framework\core\Controller
{
    public function processAction($id)
    {
        $userrequests = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->find($id);

        $this->set('userrequests', $userrequests);
    }
}