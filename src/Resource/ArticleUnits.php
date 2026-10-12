<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * ArticleUnits API resource (`/api/v3/article-units`).
 */
final class ArticleUnits extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/article-units';
	}
}
