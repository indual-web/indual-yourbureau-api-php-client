<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Projects API resource (`/api/v3/projects`).
 */
final class Projects extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/projects';
	}
}
