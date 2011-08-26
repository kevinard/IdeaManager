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
        
        <p><input type="text" name="userRequestProposals[]" value="<?php echo $proposal->getContent(); ?>"/></p>
    
        <?php endforeach; ?>
    </div>
        
    <p>
        <input id="addNewProposalButton" type="button" value="New proposal" onclick="addNewProposal()"/>
    </p>

    <p>
        <input type="submit" name="formSubmit" value="Update" />
    </p>
</form>

<script type="text/javascript">
    function addNewProposal()
    {
        var d = document;
        var container = d.createDocumentFragment();
        var p = d.createElement("p");
        var input = d.createElement("input");
        
        input.type = "text";
        input.name = "userRequestProposals[]";
        
        p.appendChild(input);
        container.appendChild(p);
        
        document.getElementById("proposals").appendChild(container);
        input.focus();
    }
</script>