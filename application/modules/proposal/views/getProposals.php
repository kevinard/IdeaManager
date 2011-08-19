PROPOSALS: 
<?php

$baseUrl = $this->getConfig()->get('siteUrl').'proposal/read/';

if(\count($proposals)) : ?> 
<ol>
    <?php foreach($proposals as $proposal) : ?> 
    
    <li><a href="<?php echo $baseUrl.$proposal->getId(); ?>"><?php echo $proposal->getContent(); ?></a></li>
    
    <?php endforeach; ?>
</ol>
    
<?php else : ?>
<p>None</p>
<?php endif; ?> 
