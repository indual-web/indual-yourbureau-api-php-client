<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * CustomerContacts API resource (`/api/v3/customer-contacts`).
 */
final class CustomerContacts extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/customer-contacts';
	}
}
