<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * EmailTemplates API resource (`/api/v3/email-templates`).
 */
final class EmailTemplates extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/email-templates';
	}
}
