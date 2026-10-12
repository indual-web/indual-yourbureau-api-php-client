<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OutgoingStates API resource (`/api/v3/outgoing-states`).
 */
final class OutgoingStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/outgoing-states';
	}
}
