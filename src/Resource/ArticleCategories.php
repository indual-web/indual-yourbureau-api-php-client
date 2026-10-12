<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * ArticleCategories API resource (`/api/v3/article-categories`).
 */
final class ArticleCategories extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/article-categories';
	}
}
