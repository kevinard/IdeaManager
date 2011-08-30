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
        <p><input type="text" name="newProposals[]" /></p>
    </div>
        
    <p>
        <input id="addNewProposalButton" type="button" value="New proposal" onclick="addNewProposal()"/>
    </p>

    <p>
        <input type="hidden" name="userRequestState" value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_NEW; ?>" />
        <input type="submit" name="formSubmit" value="Create" />
    </p>
</form>

<script type="text/javascript" src="<?php echo $this->getConfig('siteUrl')?>resources/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->getConfig('siteUrl')?>resources/js/script.js"></script>
<script type="text/javascript" src="<?php echo $this->getConfig('siteUrl')?>resources/js/jquery.cleditor.js"></script>
<script type="text/javascript">
$('#userRequestContent').cleditor({
    
    controls:     // controls to add to the toolbar
        "bold italic underline strikethrough | size " +
        "style | color removeformat | bullets numbering | outdent " +
        "indent | undo redo " +
        "alignleft center alignright justify rule link unlink | cut copy paste pastetext"
    
});
</script>
