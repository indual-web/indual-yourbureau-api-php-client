<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Settings API resource (`/api/v3/settings`) — read-only.
 */
final class Settings extends AbstractResource
{


	private const PATH = '/api/v3/settings';


	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	public function get(array $query = []): array
	{
		return $this->httpGet(self::PATH, $query);
	}
}
