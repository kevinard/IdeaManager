<form action="" method="post">
    
    <p>
        <label for="userRequestTitle">Title: </label>
        <input id="userRequestTitle" name="userRequestTitle" type="text" />
    </p>
    
    <p>
        <label for="userRequestCategory">Category: </label>
        <select name="userRequestCategory" id="userRequestCategory">
            <?php foreach($categories as $category): 
				if ($category->getParentId() !== null): ?>
            <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
            <?php endif; 
			endforeach; ?>
        </select>
    </p>

    <p>Content: </p>
    <textarea name="userRequestContent" id="userRequestContent" cols="30" rows="10"></textarea>
    
    
    <p>Proposals: </p>
    
    <div id="proposals">
        <p><input type="text" name="userRequestProposals[]" /></p>
    </div>
        
    <p>
        <input id="addNewProposalButton" type="button" value="New proposal" onclick="addNewProposal()"/>
    </p>

    <p>
        <input type="hidden" name="userRequestState" value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_NEW; ?>" />
        <input type="submit" name="formSubmit" value="Create" />
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