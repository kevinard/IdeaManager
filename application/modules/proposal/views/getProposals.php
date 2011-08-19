<?php
/**
 * View for getProposals
 */

/* @var $viewerIsOwner boolean */
/* @var $proposals array */
/* @var $proposal \application\modules\proposal\models\Proposal */
?>


PROPOSALS: 
<?php

$baseUrl = $this->getConfig()->get('siteUrl');

if(\count($proposals)) : ?> 
<ol>
    <?php foreach($proposals as $proposal) : ?> 
    
    <li>
        <a href="<?php echo $baseUrl.'proposal/read/'.$proposal->getId(); ?>"><?php echo $proposal->getContent(); ?></a>
        <div>
            <?php if($viewerIsOwner) :?>
            <a href="<?php echo $baseUrl.'proposal/delete/'.$proposal->getId(); ?>">Remove</a>
            <?php endif; ?>
            <a href="<?php echo $baseUrl.'proposalvote/update/'.$proposal->getId().'/'.$_SESSION['connectedUser']->getId(); ?>">Up-vote!</a>
        </div>
    </li>
    
    <?php endforeach; ?>
</ol>
    
<?php else : ?>
<p>None</p>
<?php endif;

if($viewerIsOwner) :?>
    <a href="<?php echo $baseUrl.'proposal/create/'.$userRequestId; ?>">Add a new proposal</a>
<?php endif; ?>