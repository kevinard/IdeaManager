<?php
namespace application\modules\userrequest\controllers;

class GetUserRequest extends \framework\core\Controller
{
	public function _before(\framework\core\Request &$request, \framework\core\Response &$response)
	{
        $var = $request->getParams();
        if (empty($var))
		{
			$url = $this->getConfig("siteUrl") . "category/listing";
			$this->getComponent("httpResponse")->redirect($url);
        }
    }

	public function processAction($userrequest_id)
	{
		$em = $this->getComponent("entityManager");

		$article = $em->getRepository('application\modules\userrequest\models\UserRequest')->find($userrequest_id);
		if (!$article)
		{
			$this->usesView = false;
			$this->getComponent('httpResponse')->redirect($url, 302, false);
			return;
		}
		$this->set('url', $this->getConfig('siteUrl'));
		$this->set('article', $article);
	}
}