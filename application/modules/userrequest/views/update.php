<form action="" method="post">

    <p>
        <label for="requestTitle">Title: </label>
        <input id="requestTitle" name="requestTitle" type="text" />
    </p>
    
    <p>
        <label for="requestCategory">Category: </label>
        <select name="requestCategory" id="requestCategory">
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    
    <p>
        <?php if($newRequest) : ?> 
        
        <input type="hidden" name="requestState" value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_NEW; ?>" />
        
        <?php else : ?> 
        
        <label for="requestState">State: </label>
        <select name="requestState" id="requestState">
            <option value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_NEW; ?>">New</option>

            <option value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_ACCEPTED; ?>">Accepted</option>
            <option value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_LATER; ?>">Later</option>
            <option value="<?php echo \application\modules\userrequest\models\UserRequest::STATE_REFUSED; ?>">Refused</option>

        </select>
        
        <?php endif; ?> 
    </p>
    
    <textarea name="requestContent" id="requestContent" cols="30" rows="10"></textarea>
    
    <p>
        <input type="submit" value="<?php echo ($newRequest) ? 'Create' : 'Update'?>" />
    </p>
</form>