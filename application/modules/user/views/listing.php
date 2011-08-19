<?php
$url = $this->getConfig('siteUrl');
?>
<h2>List of users</h2>
<a href="<?php echo $url; ?>user/add">Add a user</a>
<table>
	<tr>
		<td>Login</td>
		<td>Level</td>
		<td>Edit</td>
		<td>Delete</td>
	</tr>
<?php
foreach ($users as $user)
{
?>
	<tr>
		<td><?php echo $user->getLogin(); ?></td>
		<td><?php echo $user->getLevel() == \application\modules\user\models\User::ADMIN ? 'Admin' : 'User'; ?></td>
		<td><a href="<?php echo $this->getConfig('siteUrl'); ?>user/edit/<?php echo $user->getId(); ?>">Edit</a></td>
		<td><a href="<?php echo $this->getConfig('siteUrl'); ?>user/delete/<?php echo $user->getId(); ?>">Delete</a></td>
	</tr>
<?php
}
?>
</table>