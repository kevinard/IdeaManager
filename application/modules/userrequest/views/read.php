<?php
/**
 * View file for userrequest/read
 * 
 * @var $userrequest \application\modules\userrequest\models\UserRequest  
 */


/* @var $userRequest \application\modules\userrequest\models\UserRequest  */
/* @var $proposals string */
/* @var $comments string */
/* @var $url string */


$url = $this->getConfig('siteUrl'); ?>

<h2>
    <?php echo $userRequest->getCategory()->getName();  ?> >
    <?php echo $userRequest->getTitle(); ?>
</h2>

<?php if(isset($_SESSION['connectedUser']) 
    && $userRequest->getAuthor()->getId() === $_SESSION['connectedUser']->getId()) : ?>
<a href="<?php echo $url.'userrequest/update/'.$userRequest->getId(); ?>">Edit this request</a>
<?php endif; ?>

<h4>
    <?php echo $userRequest->getAuthor()->getLogin(); ?> 
    (<?php echo $userRequest->getDate()->format("Y-m-d"); ?>)
</h4>

<div>
    <?php echo $userRequest->getContent(); ?>
</div>


<h4>PROPOSALS: </h4>
<div>
    <?php echo $proposals; ?>
</div>


<h4>COMMENTS: </h4>
<div>
    <?php echo $comments; ?>
</div>


<?php if(isset($_SESSION['connectedUser'])) : ?>

<form action="<?php echo $url.'comment/create/'.$userRequest->getId();?>" method="post">
    <textarea name="commentContent" id="commentContent" cols="40" rows="5"></textarea>
    <p><input type="submit" value="Leave a comment" name="formSubmit" /></p>
</form>

<?php endif; ?>
