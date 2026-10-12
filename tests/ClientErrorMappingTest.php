<?php

declare(strict_types=1);

namespace YourBureau\Api\Tests;

use PHPUnit\Framework\TestCase;
use YourBureau\Api\Client;
use YourBureau\Api\ClientConfig;
use YourBureau\Api\Exception\AuthenticationException;
use YourBureau\Api\Exception\NotFoundException;
use YourBureau\Api\Exception\ValidationException;
use YourBureau\Api\Http\Response;
use YourBureau\Api\Http\TransportInterface;

final class ClientErrorMappingTest extends TestCase
{


	public function testForbiddenMapsToAuthenticationException(): void
	{
		$client = $this->clientWithStatus(403, ['error' => 'No permission']);

		$this->expectException(AuthenticationException::class);
		$client->customers()->list(['limit' => 1]);
	}



	public function testNotFoundMapsToNotFoundException(): void
	{
		$client = $this->clientWithStatus(404, ['error' => 'Not found']);

		$this->expectException(NotFoundException::class);
		$client->customers()->get(1);
	}



	public function testValidationMapsToValidationException(): void
	{
		$client = $this->clientWithStatus(400, [
			'status' => 400,
			'error' => 400,
			'messages' => ['articles' => 'At least one article is required.'],
		]);

		$this->expectException(ValidationException::class);
		$client->offers()->create(['customer_id' => 1]);
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function clientWithStatus(int $status, array $body): Client
	{
		$transport = new class ($status, $body) implements TransportInterface {
			/**
			 * @param array<string, mixed> $body
			 */
			public function __construct(
				private readonly int $status,
				private readonly array $body,
			) {
			}

			public function request(
				string $method,
				string $url,
				array $headers = [],
				?array $jsonBody = null,
			): Response {
				return new Response($this->status, json_encode($this->body, JSON_THROW_ON_ERROR));
			}
		};

		return new Client(
			new ClientConfig(apiKey: 'test-key', tenant: 'indual'),
			$transport,
		);
	}
}
