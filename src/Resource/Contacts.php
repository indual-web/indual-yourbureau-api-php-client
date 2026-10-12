<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Contacts API resource (`/api/v3/contacts`).
 */
final class Contacts extends AbstractResource
{


	private const PATH = '/api/v3/contacts';


	/**
	 * @param array<string, scalar|null> $query
	 */
	public function list(array $query = []): Page
	{
		return $this->listPage(self::PATH, $query);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return list<array<string, mixed>>
	 */
	public function listAll(array $query = []): array
	{
		return $this->listAllPages(self::PATH, $query);
	}



	/**
	 * @return array<string, mixed>
	 */
	public function get(int $contactId): array
	{
		return $this->httpGet(self::PATH . '/' . $contactId);
	}



	/**
	 * @param array<string, mixed> $payload
	 */
	public function create(array $payload): int
	{
		return $this->mutationId($this->httpPost(self::PATH, $payload));
	}
}
