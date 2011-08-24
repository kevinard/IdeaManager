<h4>COMMENTS: </h4>

<?php if(count($comments) > 0): ?>

<ol>
<?php 
$baseUrl = $this->getConfig()->get('siteUrl').'voteComment/';

foreach($comments as $comment) : ?>  
    
    <li>
        <p>
            <?php echo $comment->getUser()->getLogin(); ?> said :
            <?php echo $comment->getContent(); ?>
        </p>
        <p>Score: <?php echo $comment->getScore(); ?> <a href="<?php echo $baseUrl.$comment->getId(); ?>">+1</a></p>
    </li>
    
<?php endforeach; ?>
</ol>

<?php else : ?>
<p>None</p>
<?php endif; ?>