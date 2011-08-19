<?php
namespace application\modules\user;

abstract class securedAdminZoneController extends \application\modules\user\securedZoneController
{
	protected function _before (\framework\core\Request &$request, \framework\core\Response &$response)
	{
		parent::_before($request, $response);
		
		if (!$_SESSION['connectedUser']->isAdmin())
		{
			$this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl'), 302);
		}
	}
}