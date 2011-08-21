<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php if (isset($title)) { echo $title; } else { echo $this->getConfig('defaultTitle'); } ?></title>
	</head>
	<body>
		<h1><a href="<?php echo $this->getConfig('siteUrl');?>">TEMP</a></h1>
		
		<div id="user">
<?php
if (empty($_SESSION['connectedUser']))
{
?>
			<a href="<?php echo $this->getConfig('siteUrl'); ?>user/login">Login</a>
<?php
}
else
{
?>
			Welcome <?php echo $_SESSION['connectedUser']->getLogin(); ?>. 
			<a href="<?php echo $this->getConfig('siteUrl'); ?>user/edit/<?php echo $_SESSION['connectedUser']->getId(); ?>">Edit my profile</a> / 
			<a href="<?php echo $this->getConfig('siteUrl'); ?>user/logout">Logout</a> 
			<?php if ($_SESSION['connectedUser']->isAdmin()): ?>
				 / <a href="<?php echo $this->getConfig('siteUrl'); ?>user">Admin</a>
			<?php endif; ?>
<?php
}
?>
		</div>
		
		<div id="content">
			<?php echo $contentForLayout; ?>
                    
		</div>
	</body>
</html>
