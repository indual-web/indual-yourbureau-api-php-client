<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * OfferStates API resource (`/api/v3/offer-states`).
 */
final class OfferStates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/offer-states';
	}
}
