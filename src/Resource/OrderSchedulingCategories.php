<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OrderSchedulingCategories API resource (`/api/v3/order-scheduling-categories`).
 */
final class OrderSchedulingCategories extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/order-scheduling-categories';
	}
}
