<?php


$config = array(
    'siteUrl' => 'http://10.3.16.20/ideamanager2/',
    'routes' => array('n/<name>' => array('module' => 'website', 'action' => 'hello', 'params' => array())),
	'defaultModule' => 'category',
	'defaultAction' => 'listing',
	'defaultLayout' => 'layout',
	'defaultTitle' => 'TEMP',
	'events' => array('beforeIndex' => array('\application\modules\website\controllers\Index')),
	'securitySalt' => 'SDF4w5rW$RFWEFw4r4r34rf#$#$TFR34F34f5buhy3j5h#67h',
	'applicationFilters' => array('framework\filters\appFilters\ConnectionFilter'),
	'dbConnectionParams' => array(
		'driver' => 'pdo_mysql',
		'user' => 'root',
		'password' => 'root',
		'dbname' => 'cours_42framework',
		'host' => 'localhost'
		)
    );
