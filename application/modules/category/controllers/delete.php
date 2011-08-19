<?php

namespace application\modules\category\controllers;

class Delete extends \framework\core\Controller
{

	protected $usesView = false;

	public function processAction ($categoryId)
	{
		$url = $this->getConfig("siteUrl") . "category/listing";
		$em = $this->getComponent("entityManager");
		$category = $em->getRepository('application\modules\category\models\Category')->find($categoryId);
		if ($category)
		{
			$em->remove($category);
		}
		$this->getComponent("httpResponse")->redirect($url, 302, false);
	}

}