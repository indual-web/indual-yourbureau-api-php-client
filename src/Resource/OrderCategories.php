<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OrderCategories API resource (`/api/v3/order-categories`).
 */
final class OrderCategories extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/order-categories';
	}
}
