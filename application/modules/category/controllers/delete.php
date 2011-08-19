<?php

namespace application\modules\category\controllers;

class Delete extends \framework\core\Controller
{

	protected $usesView = false;

	public function processAction ($categoryId)
	{
		$url = $this->getConfig("siteUrl");
		$em = $this->getComponent("entityManager");
		$category = $em->getRepository('application\modules\category\models\Category')->findOneById($categoryId);
		
		if ($category)
		{
			$em->remove($category);
		}
		
		$this->getComponent("httpResponse")->redirect($url, 302, false);
	}

}