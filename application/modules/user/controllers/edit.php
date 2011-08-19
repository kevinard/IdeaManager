<?php
namespace application\modules\user\controllers;

class Edit extends \application\modules\user\securedAdminZoneController
{
	public function processAction($userId = null)
	{
		$url = $this->getConfig("siteUrl") . "user";
		if ($userId === null)
		{
			$user = new \application\modules\user\models\User();
		}
		else
		{
			$user = $this->getComponent('entityManager')->getRepository('application\modules\user\models\User')->find($userId);
			if (!$user)
			{
				$this->usesView = false;
				$this->getComponent("httpResponse")->redirect($url, 302, false);
			}
		}
		$this->set('user', $user);

		if (isset($_POST['login']) && $_POST['login'] != '' &&
				isset($_POST['level']) && $_POST['level'] != '')
		{
			$user->setLogin($_POST['login']);
			$user->setLevel($_POST['level']);

			if (isset($_POST['password']) && isset($_POST['confirm']) &&
					$_POST['password'] != "" && $_POST['password'] == $_POST['confirm'])
			{
				$user->setPassword($_POST['password']);
			}
			elseif ($userId == null)
			{
				return;
			}

			$this->getComponent('entityManager')->persist($user);

			$this->usesView = false;
			$this->getComponent("httpResponse")->redirect($url, 302, false);
		}
	}
}