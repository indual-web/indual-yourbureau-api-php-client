<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Languages API resource (`/api/v3/languages`).
 */
final class Languages extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/languages';
	}
}
