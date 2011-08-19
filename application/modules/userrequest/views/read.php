<?php
/**
 * View file for userrequest/read
 * 
 * @var $userrequest \application\modules\userrequest\models\UserRequest  
 */


/* @var $userrequest \application\modules\userrequest\models\UserRequest  */

if(isset($userrequest) && isset($proposals)) :
?>

<h2>
    <?php 
    echo $userrequest->getCategory()->getName();  ?> >
    <?php echo $userrequest->getTitle(); ?>
</h2>
<h4>
    <?php echo $userrequest->getAuthor()->getLogin(); ?> 
    (<?php echo $userrequest->getDate()->format("Y-m-d"); ?>)
</h4>
<p><?php echo $userrequest->getContent(); ?></p>

<?php echo $proposals;
endif; ?>