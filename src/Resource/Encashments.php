<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Encashments API resource (`/api/v3/encashments`).
 */
final class Encashments extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/encashments';
	}
}
