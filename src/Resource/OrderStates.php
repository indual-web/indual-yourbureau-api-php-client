<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OrderStates API resource (`/api/v3/order-states`).
 */
final class OrderStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/order-states';
	}
}
