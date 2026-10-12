<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * ProjectStates API resource (`/api/v3/project-states`).
 */
final class ProjectStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/project-states';
	}
}
