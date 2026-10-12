<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Work packages API resource (`/api/v3/work-packages`) — collection read-only.
 */
final class WorkPackages extends AbstractResource
{


	private const PATH = '/api/v3/work-packages';


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
}
