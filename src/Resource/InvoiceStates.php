<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * InvoiceStates API resource (`/api/v3/invoice-states`).
 */
final class InvoiceStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/invoice-states';
	}
}
