<?php
namespace application\modules\userrequest\controllers;

class Read extends \framework\core\Controller
{
    public function processAction($userRequestId = null)
    {
        if($userRequestId !== null)
        {
            $userRequest = $this->getComponent('entityManager')->getRepository('application\modules\userrequest\models\UserRequest')->find($userRequestId);
            $proposals = $this->createRequest('proposal', 'getProposals', array($userRequestId))->execute()->get();
            $comments = $this->createRequest('comment', 'getComments', array($userRequestId))->execute()->get();
            
            $this->set('userRequest', $userRequest);
            $this->set('proposals', $proposals);
            $this->set('comments', $comments);
        }
    }
}