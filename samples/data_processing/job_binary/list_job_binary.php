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
//$options = ['limit' => 1]; 
$sahara = $openstack->dataProcessingV1(['region' => 'RegionOne']);
$binaries = $sahara->listJobBinaries();
foreach($binaries as $binary){
print_r($binary);
}
?>

