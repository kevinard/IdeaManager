<?php
namespace application\modules\user;

abstract class securedZoneController extends \framework\core\Controller
{
	protected function _before (\framework\core\Request &$request, \framework\core\Response &$response)
	{
		parent::_before($request, $response);

		if (empty ($_SESSION['connectedUser']))
		{
			$this->getComponent('httpResponse')->redirect($this->getConfig('siteUrl').'user/login', 302);
		}
	}
}