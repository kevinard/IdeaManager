<pre>
<?php //var_dump($categories); ?>
</pre>

<form method="post" id="editCategory" action="">
<p>
	<label for="name">Name:</label>
	<input type="text" id="name" name="name" value="<?php echo $category->getName(); ?>" />
	<br />
        <label for="name">Category Parent:</label>
        <select id ="parentId" name="parentId">
            <?php foreach($categories as $category_temp): ?>
            <option value="<?php echo $category_temp->getId(); ?>">
                <?php echo $category_temp->getName(); ?>
            </option>
            <?php endforeach; ?>
        </select>
	<br />
	<input type="submit" value="Submit"/>
</p>
</form>

<?php \print_r($errors); ?>