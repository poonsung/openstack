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
		'limit' => {limit_integer},
		'sort_by' => '{sortKey}'
];
$jobs = $sahara->listJobs($options);
foreach($jobs as $job){
	print_r($job);
}
?>
