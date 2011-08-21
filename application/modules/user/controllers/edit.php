<?php
namespace application\modules\user\controllers;

class Edit extends \application\modules\user\securedZoneController
{
	public function processAction($userId = null)
	{
		$url = $this->getConfig("siteUrl") . "user";
		if ($userId === null)
		{
			$user = new \application\modules\user\models\User();
		}
		else
		{
			$user = $this->getComponent('entityManager')->getRepository('application\modules\user\models\User')->find($userId);
			if (!$user)
			{
				$this->usesView = false;
				$this->getComponent("httpResponse")->redirect($url, 302, false);
			}
		}
		$this->set('user', $user);

                //Admin verification (Login & level user)
                if($_SESSION['connectedUser']->isAdmin())
                {
                    if (isset($_POST['login']) && $_POST['login'] != '' &&
				isset($_POST['level']) && $_POST['level'] != '')
                    {
                            $user->setLogin($_POST['login']);
                            $user->setLevel($_POST['level']);
                    }
                    else
                    {
                        return;
                    }
                }

                //$Password verifications
                if (isset($_POST['password']) && isset($_POST['confirm']) &&
                                $_POST['password'] != "" && $_POST['password'] == $_POST['confirm'])
                {
                        $user->setPassword($_POST['password']);
                }
                elseif ($userId == null)
                {
                     //   return;
                }

                //Language verifications
                if (isset($_POST['lang']) && $_POST['lang'] != "")
                {
                    $user->setLang($_POST['lang']);
                
                    $this->getComponent('entityManager')->persist($user);

                    $this->usesView = false;
                    $this->getComponent("httpResponse")->redirect($url, 302, false);
                }
                else 
                {
                       return;
                }
	}
}