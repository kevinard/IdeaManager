<?php
namespace application\modules\user\controllers;

class logout extends \framework\core\Controller
{
	protected $usesView = false;

	public function processAction($redirect = true)
	{
		unset ($_SESSION['connectedUser']);
		$this->getComponent('httpResponse')->setCookie('user', null, 1);
		
		if ($redirect)
		{
			$this->getComponent("httpResponse")->redirect($this->getConfig("siteUrl"), 302, false);
		}
	}
}