<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Currencies API resource (`/api/v3/currencies`).
 */
final class Currencies extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/currencies';
	}
}
