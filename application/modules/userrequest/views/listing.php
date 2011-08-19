<?php
$url = $this->getConfig('siteUrl');
?>
<ul>
	<?php /* @var $ur \application\modules\userrequest\models\UserRequest */ foreach ($userrequests as $ur): ?>
		<li>
			<a href="<?php echo $url.'userrequest/read/'.$ur->getId() ?>"><?php echo $ur->getTitle(); ?></a>
		</li>
	<?php endforeach; ?>
</ul>