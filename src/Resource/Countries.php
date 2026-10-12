<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Countries API resource (`/api/v3/countries`).
 */
final class Countries extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/countries';
	}
}
