<?php //echo $this->getConfig()->get('siteUrl').'proposal/update/'.$proposal->getId(); ?>
<form action="" method="post">
    
    <h1><?php echo $proposal->getUserRequest()->getTitle(); ?></h1>
    
    
    <label>Proposal content : </label>
    <textarea name="propContent" id="propContent" cols="30" rows="10">
        <?php echo $proposal->getContent(); ?>
    </textarea>
    
    <input type="hidden" value="<?php echo $proposal->getId(); ?>" />
    
    <input type="submit" value="Update"/>

</form>