<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Current user's time reports (`/api/v3/my-time-reports`) — collection read-only.
 */
final class MyTimeReports extends AbstractResource
{


	private const PATH = '/api/v3/my-time-reports';


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
