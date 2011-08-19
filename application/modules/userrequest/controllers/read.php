<?php
namespace application\modules\userrequest\controllers;

class Read extends \framework\core\Controller
{
    public function processAction($userRequestId = null)
    {
        if($userRequestId !== null)
        {
            $userrequest = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->find($userRequestId);
            $proposals = $this->createRequest('proposal', 'getProposals', array($userRequestId))->execute()->get();

            $this->set('userrequest', $userrequest);
            $this->set('proposals', $proposals);
        }
    }
}