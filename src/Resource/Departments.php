<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Departments API resource (`/api/v3/departments`).
 */
final class Departments extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/departments';
	}
}
