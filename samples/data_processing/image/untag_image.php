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

$image = $sahara->getImage(['id' => '{imageId}']);
$image->removeTags('spark', '1.6.2');

?>