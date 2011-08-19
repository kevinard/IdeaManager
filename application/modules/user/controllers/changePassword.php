<?php
namespace application\modules\user\controllers;

class ChangePassword extends \application\modules\user\securedZoneController
{
	protected function _before (\framework\core\Request &$request, \framework\core\Response &$response)
	{
		parent::_before($request, $response);
		
		$userId = $request->getParams();

		if (empty($userId) || $_SESSION['connectedUser']->getId() != $userId[0])
		{
			$this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302);
		}
	}
	
	public function processAction($userId)
	{
		$url = $this->getConfig("siteUrl");
		
		$user = $this->getComponent('entityManager')->getRepository('application\modules\user\models\User')->find($userId);
		if (!$user)
		{
			$this->usesView = false;
			$this->getComponent("httpResponse")->redirect($url, 302, false);
		}
		
		if (isset($_POST['password']) && isset($_POST['confirm']) &&
				$_POST['password'] != "" && $_POST['password'] == $_POST['confirm'])
		{
			$user->setPassword($_POST['password']);

			$this->getComponent('entityManager')->persist($user);

			$this->usesView = false;
			$this->getComponent("httpResponse")->redirect($url, 302, false);
		}
	}
}