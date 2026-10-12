<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Cantons API resource (`/api/v3/cantons`).
 */
final class Cantons extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/cantons';
	}
}
