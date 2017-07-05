<?php declare(strict_types=1);

namespace OpenStack\DataProcessing\v1;

use OpenStack\Common\Api\AbstractApi;

class Api extends AbstractApi
{
	public function __construct()
	{
		$this->params = new Params();
	}

//----------------------CLUSTER -----------------------------------------------//
	public function getClusters(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'clusters',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sortKey' => $this->params->sortKey()
				]
		];
	}

	public function getCluster(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'clusters/{id}',
				'params' => [
						'id'           => $this->params->urlId('cluster'),
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker()
				]
		];
	}

	public function deleteCluster(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'clusters/{id}',
				'params' => ['id' => $this->params->urlId('cluster')],
		];
	}

	public function patchCluster(): array
	{
		return [
				'method'  => 'PATCH',
				'path'    => 'clusters/{id}',
				'params'  => [
						'id'   => $this->params->urlId('cluster'),
						'isPublic' => $this->params->isPublic(),
						'name' => $this->params->name('cluster'),
						'isProtected' => $this->params->isProtected(),
				],
		];
	}

	public function postCluster(): array
	{
		return [
				'path'    => 'clusters',
				'method'  => 'POST',
				'params'  => [
						'pluginName'            => $this->params->pluginName(),
						'hadoopVersion'           => $this->params->hadoopVersion(),
						'clusterTemplateId'        => $this->params->clusterTemplateId(),
						'defaultImageId'           => $this->params->defaultImageId(),
						'userKeypairId'               => $this->notRequired($this->params->userKeyPairId()),
						'name'     => $this->isRequired($this->params->name('cluster')),
						'neutronManagementNetwork'           => $this->params->neutronManagementNetwork()
				]
		];
	}

	public function postClusters(): array
	{
		$definition = $this->postCluster();
		$definition['path'] .= '/multiple';
		$definition['params'] = array_merge($definition['params'],[
			'count' => $this->params->count(),
			'clusterConfigs' => $this->params->clusterConfigs()
		]);
		return $definition;
	}

	public function putCluster(): array
	{
		return [
				'path'    => 'clusters/{id}',
				'method'  => 'PUT',
				'params'  => [
						'id'           => $this->params->urlId('cluster'),
						'addNodeGroups' => $this->params->addNodeGroups(),
						'resizeNodeGroups' => $this->params->resizeNodeGroups()
				]
		];
	}
	//---------------------------------------------------------------------
	public function postDataSource(): array
	{
		return [
				'path'    => 'data-sources',
				'method'  => 'POST',
				'params'  => [
						'description'		=> $this->params->description(),
						'url'				=> $this->params->url(),
						'type'				=> $this->params->dataSourceType(),
						'name'				=> $this->params->dataSourceName()
				]
		];
	}

	public function deleteDataSource(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'data-sources/{id}',
				'params' => ['id' => $this->params->urlId('datasource')]
		];
	}

	public function getDataSource(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'data-sources/{id}',
				'params' => [
						'id'           => $this->params->urlId('datasource')
				]
		];
	}

	public function getDataSources(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'data-sources',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sortKey' => $this->params->sortKey()
				]
		];
	}

	public function patchDataSource(): array
	{
		return [
				'method'  => 'PUT',
				'path'    => 'data-sources/{id}',
				'params'  => [
						'id'				=> $this->params->urlId('datasource'),
						'isPublic'			=> $this->params->isPublic(),
						'isProtected'		=> $this->params->isProtected(),
						'name'				=> $this->params->dataSourceName(),
						'description'		=> $this->params->description(),
				],
		];
	}

	///////----------------- cluster-template -------------------///////////
	public function postClusterTemplate(): array
	{
		return [
				'path'    => 'cluster-templates',
				'method'  => 'POST',
				'params'  => [
						'pluginName'            => $this->params->pluginName(),
						'hadoopVersion'      	=> $this->params->hadoopVersion(),
						'nodeGroups'			=> [
							'type'        => params::ARRAY_TYPE,
							'sentAs'	  => 'node_groups',
							'description' => 'List of nodeGroups',
							'items'       => [
								'type'       => params::OBJECT_TYPE,
								'properties' => [

									'name'         => $this->params->name('node-group-template'),
									'count'		   => $this->params->count(),
									'nodeGroupTemplateId' => $this->params->nodeGroupTemplateId(),
								],
							],
						],
						'name'     				=> $this->isRequired($this->params->name('cluster-template')),
				]
		];
	}
	public function getClusterTemplates(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'cluster-templates',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sort_by'	   => $this->params->sortkey(),
				]
		];
	}

	public function getClusterTemplate(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'cluster-templates/{id}',
				'params' => [
						'id'           => $this->params->urlId('cluster-templates')
				]
		];
	}

	public function deleteClusterTemplate(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'cluster-templates/{id}',
				'params' => ['id' => $this->params->urlId('cluster-template')],
		];
	}

	public function putClusterTemplate(): array
	{
		return [
				'method'  => 'PUT',
				'path'    => 'cluster-templates/{id}',
				'params'  => [
						'id'   		=> $this->params->urlId('cluster-template'),
						'name' 		=> $this->params->name('cluster-template'),
						'isPublic' 	=> $this->params->isPublic(),
						'pluginName'=> $this->notRequired($this->params->pluginName()),
						'hadoopVersion' => $this->notRequired($this->params->hadoopVersion())
				]
		];
	}

	//------------------start---nodegrouptemplate-----------------------//
	public function getNodeGroupTemplates()
	{
		return [
				'method' => 'GET',
				'path'   => 'node-group-templates',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sortKey' => $this->params->sortKey()
				]
		];
	}

	public function postNodeGroupTemplate()
	{
		return [
				'path'    => 'node-group-templates',
				'method'  => 'POST',
				'params'  => [
					'pluginName'            => $this->params->pluginName(),
					'hadoopVersion'           => $this->params->hadoopVersion(),
					'nodeProcesses'					=> $this->params->nodeProcesses(),
					'name'    				 => $this->isRequired($this->params->name('nodeGroupTemplate')),
					'flavorId'						=> $this->params->flavorId(),
					'description'			 => $this->params->description(),
					'availabilityZone' => $this->params->availabilityZone(),
					'imageId' 				 => $this->params->imageId(),
					'floatingIpPool' 	 => $this->params->floatingIpPool(),
					'useAutoconfig' 	 => $this->params->useAutoconfig(),
					'isProxyGateway'	 => $this->params->isProxyGateway(),
					'isPublic'				 => $this->params->isPublic(),
					'isProtected'			 => $this->params->isProtected()
				]
		];
	}
	public function getNodeGroupTemplate()
	{
		return [
				'method' => 'GET',
				'path'   => 'node-group-templates/{id}',
				'params' => [
						'id'           => $this->params->urlId('nodeGroupTemplate')
				]
		];
	}
	public function deleteNodeGroupTemplate()
	{
		return [
				'method' => 'DELETE',
				'path'   => 'node-group-templates/{id}',
				'params' => ['id' => $this->params->urlId('nodeGroupTemplate')]
		];
	}

	public function putNodeGroupTemplate()
	{
		return [
				'method'  => 'PUT',
				'path'    => 'node-group-templates/{id}',
				'params'  => [
						'id'  						 => $this->params->urlId('nodeGroupTemplate'),
						'name'						 => $this->params->name('nodeGroupTemplate'),
						'description'			 => $this->params->description(),
						'availabilityZone' => $this->params->availabilityZone(),
						'imageId' 				 => $this->params->imageId(),
						'floatingIpPool' 	 => $this->params->floatingIpPool(),
						'useAutoconfig' 	 => $this->params->useAutoconfig(),
						'isProxyGateway'	 => $this->params->isProxyGateway(),
						'isPublic'				 => $this->params->isPublic(),
						'isProtected'			 => $this->params->isProtected()
				]
		];
	}
	//-------------------end--nodegrouptemplate--------------------------//

	//--------------start----job bianry------------------//
	public function getJobBinaries(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binaries',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sortKey'      => $this->params->sortKey(),
						'sortDir'      => $this->params->sortDir()
				]
		];
	}

	public function getJobBinary(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binaries/{id}',
				'params' => ['id'=> $this->params->urlId('binary')]
		];
	}

	public function postJobBinary(): array
	{
		return [
				'path'    => 'job-binaries',
				'method'  => 'POST',
				'params'  => [
						'url'             => $this->params->url(),
						'name'            => $this->params->name('job_binary'),
						'description'     => $this->params->description(),
						'extra'           => $this->params->extra()
				]
		];
	}

	public function deleteJobBinary(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'job-binaries/{id}',
				'params' => ['id'=> $this->params->urlId('job_binary')]
		];
	}

	public function putJobBinary(): array
	{
		return [
				'method'  => 'PUT',
				'path'    => 'job-binaries/{id}',
				'params'  => [
						'id'          => $this->params->urlId('job_binary'),
						'url'		  => $this->params->url(),
						'isPublic'    => $this->params->isPublic(),
						'name'        => $this->params->name('job_binary'),
						'isProtected' => $this->params->isProtected(),
				],
		];
	}

	public function getJobBinaryData(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binaries/{id}/data',
				'params' => ['id'=> $this->params->urlId('job_binary')]
		];
	}

	//--------------end----job bianry------------------//

	//---------------start------job binary internal-------//
	public function putJobBinaryInternal(): array
	{
		return [
				'method' => 'PUT',
				'path'   => 'job-binary-internals/{name}',
				'params' => [
					'name'=> $this->params->name('job_binary_internal')
			]
		];
	}

	public function getJobBinaryInternalData(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binary-internals/{id}/data',
				'params' => [
					'id'=> $this->params->urlId('job_binary_internal')
				]
		];
	}

	public function getJobBinaryInternal(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binary-internals/{id}',
				'params' => [
					'id'=> $this->params->urlId('job_binary_internal')
				]
		];
	}

	public function getJobBinaryInternals(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'job-binary-internals',
				'params' => [
					'limit' => $this->params->limit(),
					'marker'=> $this->params->marker(),
					'sortKey' => $this->params->sortKey()
				]
		];
	}

	public function deleteJobBinaryInternal(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'job-binary-internals/{id}',
				'params' => [
					'id'=> $this->params->urlId('job_binary_internal')
				]
		];
	}

	public function patchJobBinaryInternals(): array
	{
		return [
				'method' => 'PATCH',
				'path'   => 'job-binary-internals/{id}',
				'params' => [
					'id'=> $this->params->urlId('job_binary_internal'),
					'name'=> $this->params->name('job_binary_internal'),
					'isProtected' => $this->params->isProtected(),
					'isPublic' => $this->params->isProtected()
			]
		];
	}
	//--------------end-------job binary internal--------//



	////------------------job(template)-------------------------//
	public function postJob(): array
	{
		return [
				'path'    => 'jobs',
				'method'  => 'POST',
				'params'  => [
						'description'          	=> $this->params->description(),
						'mains'      			=> [
							'type'			=> params:: ARRAY_TYPE,
							'description'	=> 'The list of the job object and their properties.',
							'required'		=> true
						],
						'libs'					=> [
							'type'        	=> params::ARRAY_TYPE,
							'description' 	=> 'The list of the job object properties.',
							'required'		=> true
						],
						'type'					=> [
							'type'			=> params:: STRING_TYPE,
							'description'	=> 'The type of the data source object.',
							'required'		=> true
						],
						'name'     				=> $this->isRequired($this->params->name('job'))
				]
		];
	}
	public function getJobs(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'jobs',
				'params' => [
						'limit'        => $this->params->limit(),
						'marker'       => $this->params->marker(),
						'sort_by'	   => $this->params->sortkey()
				]
		];
	}

	public function getJob(): array
	{
		return [
				'method' => 'GET',
				'path'   => 'jobs/{id}',
				'params' => [
						'id'           => $this->params->urlId('jobs')
				]
		];
	}

	public function deleteJob(): array
	{
		return [
				'method' => 'DELETE',
				'path'   => 'jobs/{id}',
				'params' => ['id' => $this->params->urlId('jobs')]
		];
	}

	public function patchJob(): array
	{
		return [
				'method'  => 'PATCH',
				'path'    => 'jobs/{id}',
				'params'  => [
						'id'   		=> $this->params->urlId('jobs'),
						'name' 		=> $this->params->name('job'),
						'isPublic' 	=> $this->params->isPublic(),
						'description'=> $this->params->description()
				]
		];
	}

//---------------------------plugin-----------------------------------
	public function getPlugin(): array
	{
		return [
			'method' => 'GET',
			'path'   => 'plugins/{pluginName}',
			//'path'   => 'plugins/{pluginName}/{version}',
			'params' => [
				'pluginName'          =>	$this->params->pluginName('plugin'),
				//'version'						=>	$this->params->version('plugin')
			]
		];
	}

	public function getPlugins(): array
	{
		return [
			'method' => 'GET',
			'path'   => 'plugins',
			'params' => [

			]
		];
	}
}


?>