#!/usr/bin/env php
<?php
 
require 'vendor/autoload.php';
 
use OpenStack\OpenStack;
 
$openstack = new OpenStack([
    'authUrl' => 'http://203.185.71.2:5000/v3/',
    'user'    => [
        'name'       => 'siit',
        'password' => 'Siit#60!',
        'domain' => [ 'name' => 'Default' ]
    ],
    'scope'   => [
        'project' => [
             'name' => 'php',
             'domain' => [ 'name' => 'Default' ]
        ]
    ]
]);
 
$sahara = $openstack->dataProcessingV1(['region' => 'RegionOne']);
$binary = $sahara->getJobBinary(['id' => '373d640a-d214-43be-8a56-04fac9076049']);
$binary->url = 'swift://container/new-jar-example.jar';
$binary->name = 'new-jar-example.jar';
$binary->description= 'new-jar-example.jar';
$binary->isPublic = false;
$binary->isProtected = false;
$binary->update();
?>

