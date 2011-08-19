<?php
namespace application\modules\user\controllers;

class listing extends \application\modules\user\securedAdminZoneController
{
	public function processAction()
	{
		$users = $this->getComponent('entityManager')->getRepository('application\modules\user\models\User')->findAll();

		$this->set('users', $users);
	}
}