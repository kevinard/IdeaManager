<ol>
<?php

$baseUrl = $this->getConfig()->get('siteUrl').'proposal/read/';

foreach($proposals as $proposal) : ?> 
    
    <li><a href="<?php echo $baseUrl.$proposal->getId(); ?>>"><?php echo $proposal->getContent(); ?></a></li>
    
<?php endforeach; ?> 
</ol>