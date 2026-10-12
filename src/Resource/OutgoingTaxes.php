<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OutgoingTaxes API resource (`/api/v3/outgoing-taxes`).
 */
final class OutgoingTaxes extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/outgoing-taxes';
	}
}
