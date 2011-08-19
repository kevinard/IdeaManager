<form action="" method="post">
    
    <label for="proposalContent">Proposal content : </label>
    <textarea id="proposalContent" name="propContent">
    </textarea>
    
    <input type="hidden" value="<?php echo $proposal->getUserRequest()->getId(); ?>"/>
    
    <input type="submit" value="Create"/>
</form>