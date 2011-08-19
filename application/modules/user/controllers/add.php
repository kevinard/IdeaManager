<?php
namespace application\modules\user\controllers;

class Add extends \application\modules\user\securedAdminZoneController
{
	protected $usesView = false;

	public function processAction()
	{
		$this->setResponse($this->createRequest('user', 'edit')->execute());
	}
}