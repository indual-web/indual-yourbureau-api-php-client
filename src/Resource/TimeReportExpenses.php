<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * TimeReportExpenses API resource (`/api/v3/time-report-expenses`).
 */
final class TimeReportExpenses extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/time-report-expenses';
	}
}
