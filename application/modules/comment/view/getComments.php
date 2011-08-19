<ol>
<?php 
$baseUrl = $this->getConfig()->get('siteUrl').'voteComment/';

foreach($comments as $comment) : ?>  
    
    <li>
        <p><?php echo $comment->getUser()->getLogin(); ?> said : </p>
        <p><?php echo $comment->getContent(); ?></p>
        <p><?php echo $comment->getScore(); ?> <a href="<?php echo $baseUrl.$comment->getId(); ?>">+1</a></p>
    </li>
    
<?php endforeach; ?>
</ol>