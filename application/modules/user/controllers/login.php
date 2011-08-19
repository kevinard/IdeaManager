<?php
namespace application\modules\user\controllers;

class login extends \framework\core\Controller
{
	public function processAction()
	{
		if (isset($_POST['login']) && $_POST['login'] != '' &&
				isset($_POST['password']) && $_POST['password'] != '')
		{
			$user = $this->createRequest('user', 'authenticate', array($_POST['login'], $_POST['password']))->execute()->get();

			if ($user['ok'])
			{
				$_SESSION['connectedUser'] = $user['user'];
				
				$url = $this->getConfig('siteUrl');
				
				$this->usesView = false;
				$this->getComponent("httpResponse")->redirect($url, 302, false);
			}
		}
	}
}