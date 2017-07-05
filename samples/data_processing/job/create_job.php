#!/usr/bin/env php
<?php
 
require 'vendor/autoload.php';
 
use OpenStack\OpenStack;
 
$openstack = new OpenStack([
    'authUrl' => '{authUrl}',
    'user'    => [
        'name'       => '{userName}',
        'password' => '{password}',
        'domain' => [ 'name' => '{userDomain}' ]
    ],
    'scope'   => [
        'project' => [
             'name' => '{projectName}',
             'domain' => [ 'name' => '{projectDomain}' ]
        ]
    ]
]);
 
$sahara = $openstack->dataProcessingV1(['region' => '{region}']);

$options = [
		'description'  	=> '{description}',
		'mains' 		=>[ '{mains}'],
		'libs' 			=> ['{libs}'],
		'type'			=> '{type}',
		'name' 			=> '{name}'
		
];

$job= $sahara->createJob($options);
print_r($job);

?>