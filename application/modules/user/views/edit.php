<form method="post" id="editUser" action="">

<?php if($_SESSION['connectedUser']->isAdmin()): ?>    
<p>
	<label for="login">Login :</label>
	<input type="text" id="login" name="login" value="<?php echo $user->getLogin(); ?>" />
</p>
<p>
	<label for="level">Level :</label>
	<select name="level" id="level">
		<option value="<?php echo \application\modules\user\models\User::ADMIN; ?>"<?php if ($user->getLevel() == \application\modules\user\models\User::ADMIN) { echo ' selected="selected"'; } ?>>Admin</option>
		<option value="<?php echo \application\modules\user\models\User::USER; ?>"<?php if ($user->getLevel() == \application\modules\user\models\User::USER) { echo ' selected="selected"'; } ?>>User</option>
	</select>
</p>
<?php endif; ?>

<p>
	<label for="password">Password :</label>
	<input type="password" id="password" name="password" value="" />
</p>
<p>
	<label for="confirm">Confirm :</label>
	<input type="password" id="confirm" name="confirm" value="" />
</p>
<p>
	<label for="lang">Language :</label>
	<select name="lang" id="lang">
            <?php foreach($this->getConfig("languagesAllowed") as $lang): ?>
		<option value="<?php echo $lang ?>" <?php echo ($user->getLang()===$lang)?"selected":""; ?> ><?php echo $lang ?></option>
            <?php endforeach; ?>
        </select>
</p>
<p>
	<input type="submit" value="Submit"/>
</p>
</form>