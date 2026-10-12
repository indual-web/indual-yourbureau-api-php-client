<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * BankAccounts API resource (`/api/v3/bank-accounts`).
 */
final class BankAccounts extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/bank-accounts';
	}
}
