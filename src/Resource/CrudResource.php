<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Standard list/get/create/update/delete resource against one `/api/v3/...` collection.
 */
abstract class CrudResource extends AbstractResource
{


	abstract protected function path(): string;



	/**
	 * @param array<string, scalar|null> $query
	 */
	public function list(array $query = []): Page
	{
		return $this->listPage($this->path(), $query);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return list<array<string, mixed>>
	 */
	public function listAll(array $query = []): array
	{
		return $this->listAllPages($this->path(), $query);
	}



	/**
	 * @return array<string, mixed>
	 */
	public function get(int $id): array
	{
		return $this->httpGet($this->path() . '/' . $id);
	}



	/**
	 * @param array<string, mixed> $payload
	 */
	public function create(array $payload): int
	{
		return $this->mutationId($this->httpPost($this->path(), $payload));
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function update(int $id, array $payload): array
	{
		return $this->httpPatch($this->path() . '/' . $id, $payload);
	}



	public function delete(int $id): void
	{
		$this->httpDelete($this->path() . '/' . $id);
	}
}
