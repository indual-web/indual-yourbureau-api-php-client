<?php

declare(strict_types=1);

namespace YourBureau\Api\Tests;

use PHPUnit\Framework\TestCase;
use YourBureau\Api\ClientConfig;

final class ClientConfigTest extends TestCase
{


	public function testNormalizedBaseUrlStripsTrailingSlash(): void
	{
		$config = new ClientConfig(
			apiKey: 'test-key',
			tenant: 'indual',
			baseUrl: 'https://api.yourbureau.ch/',
		);

		$this->assertSame('https://api.yourbureau.ch', $config->normalizedBaseUrl());
	}



	public function testEmptyApiKeyIsRejected(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		new ClientConfig(apiKey: '', tenant: 'indual');
	}



	public function testEmptyTenantIsRejected(): void
	{
		$this->expectException(\InvalidArgumentException::class);
		new ClientConfig(apiKey: 'test-key', tenant: '');
	}
}
