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


$url = $this->getConfig('siteUrl'); 

switch($userRequest->getState())
{
    case \application\modules\userrequest\models\UserRequest::STATE_REFUSED :
        $state = 'refused';
        break;
    case \application\modules\userrequest\models\UserRequest::STATE_ACCEPTED :
        $state = 'accepted';
        break;
    case \application\modules\userrequest\models\UserRequest::STATE_LATER :
        $state = 'postponed';
        break;
    case \application\modules\userrequest\models\UserRequest::STATE_NEW :
    default :
        $state = 'new';
        break;
}
?>

<h2 id="userRequestTitle">
    <?php echo $userRequest->getCategory()->getName();  ?> >
    <?php echo $userRequest->getTitle(); ?>
</h2>
<h4>
    <?php echo $userRequest->getAuthor()->getLogin(); ?> 
    (<?php echo $userRequest->getDate()->format("Y-m-d"); ?>)
</h4>

<p id="userRequestState" class="state_<?php echo $state; ?>">This request is <?php echo $state; ?></p>

<?php if(isset($_SESSION['connectedUser']) 
    && $userRequest->getAuthor()->getId() === $_SESSION['connectedUser']->getId()) : ?>

<div id="ownerQuickActions">
    <a href="<?php echo $url.'userrequest/accept/'.$userRequest->getId(); ?>">Accept</a>
    |
    <a href="<?php echo $url.'userrequest/refuse/'.$userRequest->getId(); ?>">Refuse</a>
    |
    <a href="<?php echo $url.'userrequest/postpone/'.$userRequest->getId(); ?>">Postpone</a>
    |
    <a href="<?php echo $url.'userrequest/update/'.$userRequest->getId(); ?>">Edit</a>
    |
    <a href="<?php echo $url.'userrequest/delete/'.$userRequest->getId(); ?>">Delete</a>
</div>

<?php endif; ?>

<div id="userRequestContent">
    <?php echo $userRequest->getContent(); ?>
</div>


<h4>PROPOSALS: </h4>
<div id="userRequestProposals">
    <?php echo $proposals; ?>
</div>


<h4>COMMENTS: </h4>
<div id="userRequestComments">
    <?php echo $comments; ?>
</div>


<?php if(isset($_SESSION['connectedUser'])) : ?>

<form action="<?php echo $url.'comment/create/'.$userRequest->getId();?>" method="post">
    <textarea name="commentContent" id="commentContent" cols="40" rows="5"></textarea>
    <p><input type="submit" value="Leave a comment" name="formSubmit" /></p>
</form>

<?php endif; ?>
