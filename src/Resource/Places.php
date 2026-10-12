<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Places API resource (`/api/v3/places`).
 */
final class Places extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/places';
	}
}
