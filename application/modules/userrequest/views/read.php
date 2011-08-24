<?php
/**
 * View file for userrequest/read
 * 
 * @var $userrequest \application\modules\userrequest\models\UserRequest  
 */


/* @var $userRequest \application\modules\userrequest\models\UserRequest  */
/* @var proposals string */
/* @var $url string */

$url = $this->getConfig()->get('siteUrl');

//$userConnected = 

$url = $this->getConfig('siteUrl');
if(isset($userRequest) && isset($proposals)) :
?>

<h2>
    <?php 
    echo $userRequest->getCategory()->getName();  ?> >
    <?php echo $userRequest->getTitle(); ?>
</h2>
<h4>
    <?php echo $userRequest->getAuthor()->getLogin(); ?> 
    (<?php echo $userRequest->getDate()->format("Y-m-d"); ?>)
</h4>
<p><?php echo $userRequest->getContent(); ?></p>

<?php echo $proposals;
endif; 
?>



<?php echo $comments; 

if(isset($_SESSION['connectedUser'])) : ?>


<form action="<?php echo $url.'comment/create/'.$userRequest->getId();?>" method="post">
    <textarea name="commentContent" id="commentContent" cols="40" rows="5"></textarea>
    <p><input type="submit" value="Leave a comment" name="formSubmit" /></p>
</form>

<?php endif; 

if(isset($_SESSION['connectedUser']) && $userRequest->getAuthor()->getId() === $_SESSION['connectedUser']->getId()) : ?>

<a href="<?php echo $url.'userrequest/update/'.$userRequest->getId(); ?>">Edit</a>

<?php endif; ?>
