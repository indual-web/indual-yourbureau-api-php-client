<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Salutations API resource (`/api/v3/salutations`).
 */
final class Salutations extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/salutations';
	}
}
