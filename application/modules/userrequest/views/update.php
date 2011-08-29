<?php

/* @var $userRequest \application\modules\userrequest\models\UserRequest */

?>

<form action="" method="post">

    <p>
        <label for="userRequestTitle">Title: </label>
        <input id="userRequestTitle" name="userRequestTitle" type="text" value="<?php echo $userRequest->getTitle(); ?>"/>
    </p>
    
    <p>
        <label for="userRequestCategory">Category: </label>
        <select name="userRequestCategory" id="userRequestCategory">
            <?php foreach($categories as $category): 
				if ($category->getParentId() !== null): ?>
            <option <?php echo ($category->getId() === $userRequest->getCategory()->getId()) ? 'selected="selected"' : '';?>
                value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
            <?php endif; 
			endforeach; ?> 
        </select>
    </p>
    
    <p>
        <label for="userRequestState">State: </label>
        <select name="userRequestState" id="userRequestState">
            <option <?php echo ($userRequest->getState() === \application\modules\userrequest\models\UserRequest::STATE_NEW) ? 'selected="selected"' : '' ;?>
                value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_NEW; ?>">New</option>
            <option <?php echo ($userRequest->getState() === \application\modules\userrequest\models\UserRequest::STATE_ACCEPTED) ? 'selected="selected"' : '' ;?>
                value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_ACCEPTED; ?>">Accepted</option>
            <option <?php echo ($userRequest->getState() === \application\modules\userrequest\models\UserRequest::STATE_LATER) ? 'selected="selected"' : '' ;?>
                value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_LATER; ?>">Later</option>
            <option <?php echo ($userRequest->getState() === \application\modules\userrequest\models\UserRequest::STATE_REFUSED) ? 'selected="selected"' : '' ;?>
                value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_REFUSED; ?>">Refused</option>

        </select>
    </p>
    
    <p>Content: </p>
    <textarea name="userRequestContent" id="userRequestContent" cols="30" rows="10"><?php echo $userRequest->getContent(); ?></textarea>
    
    
    <p>Proposals: </p>
    <div id="proposals">
    
        <?php foreach($proposals as $proposal) : ?>
        
        <p>
            <input type="text" name="oldProposals[<?php echo $proposal->getId(); ?>]" value="<?php echo $proposal->getContent(); ?>"/>
            <input type="button" value="Delete" onclick="deleteProposal(this.parentNode, <?php echo $proposal->getId(); ?>)" />
        </p>
    
        <?php endforeach; ?>
    </div>
        
    <p>
        <input id="addNewProposalButton" type="button" value="New proposal" onclick="addNewProposal()"/>
    </p>

    <p>
        <input type="submit" name="formSubmit" value="Update" />
    </p>
</form>

<script type="text/javascript" src="<?php echo $this->getConfig('siteUrl')?>resources/js/script.js"></script>