<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * PublicHolidays API resource (`/api/v3/public-holidays`).
 */
final class PublicHolidays extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/public-holidays';
	}
}
