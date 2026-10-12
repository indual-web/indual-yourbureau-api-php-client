<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * AbsenceTypes API resource (`/api/v3/absence-types`).
 */
final class AbsenceTypes extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/absence-types';
	}
}
