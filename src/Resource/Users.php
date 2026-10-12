<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Users API resource (`/api/v3/users`).
 */
final class Users extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/users';
	}
}
