<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Articles API resource (`/api/v3/articles`).
 */
final class Articles extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/articles';
	}
}
