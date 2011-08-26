<?php if(count($comments) > 0): ?>

<ol>
<?php 
$url = $this->getConfig()->get('siteUrl').'comment/vote/';

foreach($comments as $comment) : ?>  
    
    <li>
        <p>
            <?php echo $comment->getUser()->getLogin(); ?> said :
            <?php echo $comment->getContent(); ?>
        </p>
        <p>Score: <?php echo $comment->getScore(); ?> 
            <?php if(isset($_SESSION['connectedUser'])) : ?>    
            <a href="<?php echo $url.$comment->getId(); ?>">+1</a>
            <?php endif; ?>
        </p>
    </li>
    
<?php endforeach; ?>
</ol>

<?php else : ?>
<p>None</p>
<?php endif; ?>
