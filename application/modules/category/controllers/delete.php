<?php

namespace application\modules\category\controllers;

class Delete extends \framework\core\Controller
{

	protected $usesView = false;

	public function processAction ($categoryId)
	{
		$url = $this->getConfig("siteUrl");
		$em = $this->getComponent("entityManager");
		$category = $em->getRepository('application\modules\category\models\Category')->find($categoryId);
		$userrequests = $this->createRequest('userrequest', 'getUserRequests', array($categoryId))->execute()->get();
		
		if ($category)
		{
			$em->remove($category);
			
			foreach ($userrequests as $ur)
			{
				$em->remove($ur);
			}
		}
		
		$this->getComponent("httpResponse")->redirect($url, 302, false);
	}

}