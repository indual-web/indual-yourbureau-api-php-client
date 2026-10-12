<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Contacts API resource (`/api/v3/contacts`).
 */
final class Contacts extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/contacts';
	}
}
