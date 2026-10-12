<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Current user (`/api/v3/my-user`).
 */
final class MyUser extends AbstractResource
{


	private const PATH = '/api/v3/my-user';


	/**
	 * @return array<string, mixed>
	 */
	public function get(): array
	{
		return $this->httpGet(self::PATH);
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function update(array $payload): array
	{
		return $this->httpPatch(self::PATH, $payload);
	}
}
