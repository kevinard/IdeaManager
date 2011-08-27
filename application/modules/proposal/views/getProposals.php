<?php
/**
 * View for getProposals
 */

/* @var $viewerIsOwner boolean */
/* @var $proposals array */
/* @var $proposal \application\modules\proposal\models\Proposal */
?>

<?php

$baseUrl = $this->getConfig()->get('siteUrl');

if(\count($proposals)) : ?> 
<ol>
    <?php foreach($proposals as $proposal) : ?> 
    
    <li>
        <!-- a href="<?php echo $baseUrl.'proposal/read/'.$proposal->getId(); ?>" -->
        <?php echo $proposal->getContent(); ?>
        <!-- /a -->
        <div>
            <p>
                Score : <?php echo $proposal->getScore(); ?> 
                <?php if(isset($_SESSION['connectedUser'])): ?>
                    
                    <?php if($viewerIsOwner) : ?>
                    | <a href="<?php echo $baseUrl.'proposal/delete/'.$proposal->getId(); ?>">Remove</a>
                    <?php endif; ?>
                    | <a href="<?php echo $baseUrl.'proposal/vote/'.$proposal->getId(); ?>">Up-vote!</a>

                <?php endif; ?>
            </p>
        </div>
    </li>
    
    <?php endforeach; ?>
</ol>
    
<?php else : ?>
<p>None</p>
<?php endif; ?>