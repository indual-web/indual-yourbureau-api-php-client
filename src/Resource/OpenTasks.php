<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OpenTasks API resource (`/api/v3/open-tasks`).
 */
final class OpenTasks extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/open-tasks';
	}
}
