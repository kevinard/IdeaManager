<?php

namespace application\modules\userrequest\controllers;

class Delete extends \application\modules\user\securedZoneController
{

	protected $usesView = false;

	public function processAction ($userrequest_id)
	{
		
		$em = $this->getComponent("entityManager");
		$userrequest = $em->getRepository('application\modules\category\models\UserRequest')->find($userrequest_id);

                $url = $this->getConfig("siteUrl") . "category/listing" . $userrequest->category;
                
		if ($userrequest)
		{
			$em->remove($userrequest);
		}
		$this->getComponent("httpResponse")->redirect($url, 302, false);
	}

}