<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * User absences API resource (`/api/v3/user-absences`) — read-only.
 */
final class UserAbsences extends AbstractResource
{


	private const PATH = '/api/v3/user-absences';


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
	public function get(int $userAbsenceId): array
	{
		return $this->httpGet(self::PATH . '/' . $userAbsenceId);
	}
}
