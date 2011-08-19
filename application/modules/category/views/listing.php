<ol>
<?php 
$url = $this->getConfig('siteUrl'); 
foreach($categories as $category) : ?>

    <li><a href="<?php echo $url.'category/listing/'.$category->getId(); ?>"><?php echo $category->getName(); ?> (<?php echo count($category->getSubCategories())?>)</a></li>


<?php endforeach; ?>
</ol>

<a href="<?php echo $url.'/userrequest/create/'; ?>">Create a new request</a> <br />
<a href="<?php echo $url.'/category/create/'; ?>">Create a new category</a>