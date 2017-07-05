<?php declare(strict_types=1);

namespace OpenStack\DataProcessing\v1\Models;


use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\OperatorResource;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;
use Psr\Http\Message\StreamInterface;
use OpenStack\Common\Transport\Utils;

class JobBinary extends OperatorResource implements Listable, Retrievable, Creatable, Deletable
{

	public $description;
	public $url;
	public $tenantId;
	public $createdAt;
	public $updatedAt;
	public $isProtected;
	public $isPublic;
	public $id;
	public $name;

	protected $resourceKey = 'job_binary';
	protected $resourcesKey = 'binaries';

	protected $aliases = [
			'tenant_id'                  => 'tenantId',
			'created_at'                 => 'createdAt',
			'updated_at'                 => 'updatedAt',
			'is_protected'               => 'isProtected',
			'is_public'                  => 'isPublic'

	];

	public function retrieve()
	{
		$response = $this->execute($this->api->getJobBinary(), $this->getAttrs(['id']));
		$this->populateFromResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $userOptions): Creatable
	{
		$response=$this->execute($this->api->postJobBinary(), $userOptions);
		return $this->populateFromResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete()
	{
		$this->execute($this->api->deleteJobBinary(), $this->getAttrs(['id']));
	}

	public function update()
	{
		$response = $this->execute($this->api->putJobBinary(), $this->getAttrs(['id','url','name', 'isPublic', 'isProtected']));
		$this->populateFromResponse($response);
	}

	public function downloadData(): StreamInterface
	{
		$response = $this->executeWithState($this->api->getJobBinaryData());
		return $response->getBody();
	}

	public function getJobBinaryInternals(array $options = []): array
	{
		$response = $this->execute($this->api->getJobBinaryInternals(), $options);
		return Utils::jsonDecode($response);
	}
	
	public function getJobBinaryInternal(array $options = []): array
	{
		$response = $this->execute($this->api->getJobBinaryInternal(), $options);
		return Utils::jsonDecode($response);
	}
}