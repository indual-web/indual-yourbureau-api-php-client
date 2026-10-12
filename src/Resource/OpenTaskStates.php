<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OpenTaskStates API resource (`/api/v3/open-task-states`).
 */
final class OpenTaskStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/open-task-states';
	}
}
