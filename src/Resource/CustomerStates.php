<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * CustomerStates API resource (`/api/v3/customer-states`).
 */
final class CustomerStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/customer-states';
	}
}
