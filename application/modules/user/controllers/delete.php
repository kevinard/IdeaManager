<?php
namespace application\modules\user\controllers;

class Delete extends \application\modules\user\securedAdminZoneController
{
	protected $usesView = false;

	public function _before(\framework\core\Request &$request, \framework\core\Response &$response)
	{
        $var = $request->getParams();
        if (empty($var))
		{
			$url = $this->getConfig("siteUrl") . "user";
			$this->getComponent("httpResponse")->redirect($url);
        }
    }

	public function processAction($userId)
	{
		$url = $this->getConfig("siteUrl") . "user";
		$em = $this->getComponent("entityManager");
		$user = $em->getRepository('application\modules\user\models\User')->find($userId);
		if ($user)
		{
			$em->remove($user);
		}

		$this->getComponent("httpResponse")->redirect($url, 302, false);
	}
}