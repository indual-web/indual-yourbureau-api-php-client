<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Distributors API resource (`/api/v3/distributors`).
 */
final class Distributors extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/distributors';
	}
}
