<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Customers API resource (`/api/v3/customers`).
 */
final class Customers extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/customers';
	}
}
