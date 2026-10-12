<?php

declare(strict_types=1);

namespace YourBureau\Api;

/**
 * Configuration for the yourBureau API client.
 */
final class ClientConfig
{


	public function __construct(
		public readonly string $apiKey,
		public readonly string $tenant,
		public readonly string $baseUrl = 'https://api.yourbureau.ch',
		public readonly int $connectTimeoutSeconds = 10,
		public readonly int $timeoutSeconds = 30,
		public readonly bool $verifySsl = true,
		public readonly ?string $userAgent = 'yourbureau/api-client',
	) {
		if ($this->apiKey === '') {
			throw new \InvalidArgumentException('apiKey must not be empty.');
		}

		if ($this->tenant === '') {
			throw new \InvalidArgumentException('tenant must not be empty.');
		}

		if ($this->baseUrl === '') {
			throw new \InvalidArgumentException('baseUrl must not be empty.');
		}
	}



	/**
	 * Normalized base URL without a trailing slash.
	 */
	public function normalizedBaseUrl(): string
	{
		return rtrim($this->baseUrl, '/');
	}
}
