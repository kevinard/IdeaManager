<?php
namespace application\modules\user\controllers;

class authenticate extends \framework\core\Controller
{
	protected $usesView = false;
	public function processAction($login, $password, $needHash = true)
	{
		if ($needHash)
		{
			$password = \hash('sha512', $this->getConfig('securitySalt').$password);
		}

		$user = $this->getComponent('entityManager')->getRepository('application\modules\user\models\User')->findOneByLogin($login);
		if (!$user || $user->getPassword() !== $password)
		{
			$this->getResponse()->set(array('ok' => false));
		}
		else
		{
			$this->getResponse()->set(array('ok' => true, 'user' => $user));
		}
	}
}