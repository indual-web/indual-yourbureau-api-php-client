<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OpenTaskCategories API resource (`/api/v3/open-task-categories`).
 */
final class OpenTaskCategories extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/open-task-categories';
	}
}
