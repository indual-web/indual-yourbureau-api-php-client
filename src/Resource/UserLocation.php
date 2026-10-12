<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * User location API resource (`/api/v3/user-location`).
 */
final class UserLocation extends AbstractResource
{


	private const PATH = '/api/v3/user-location';


	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function create(array $payload): array
	{
		return $this->httpPost(self::PATH, $payload);
	}
}
