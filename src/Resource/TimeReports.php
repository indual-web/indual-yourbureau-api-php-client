<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * TimeReports API resource (`/api/v3/time-reports`).
 */
final class TimeReports extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/time-reports';
	}
}
