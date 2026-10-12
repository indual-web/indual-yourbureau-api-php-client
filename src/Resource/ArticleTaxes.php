<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * ArticleTaxes API resource (`/api/v3/article-taxes`).
 */
final class ArticleTaxes extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/article-taxes';
	}
}
