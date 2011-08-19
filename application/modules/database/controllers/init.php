<?php
namespace application\modules\database\controllers;

class Init extends \framework\core\Controller
{
	protected $usesView = false;
	
	public function processAction()
	{
		$em = $this->getComponent('entityManager');
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		
		$classes = array(
			$em->getClassMetadata('application\modules\user\models\User'),
			$em->getClassMetadata('application\modules\comment\models\Comment'),
			$em->getClassMetadata('application\modules\proposal\models\Proposal'),
			$em->getClassMetadata('application\modules\userrequest\models\UserRequest'),
			$em->getClassMetadata('application\modules\category\models\Category'),
			$em->getClassMetadata('application\modules\proposalvote\models\ProposalVote'),
			$em->getClassMetadata('application\modules\commentvote\models\CommentVote')
			);
			
		$tool->dropDatabase();
		$tool->createSchema($classes);
	}
}

