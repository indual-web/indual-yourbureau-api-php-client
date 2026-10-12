<?php

declare(strict_types=1);

namespace YourBureau\Api\Tests;

use PHPUnit\Framework\TestCase;
use YourBureau\Api\Client;
use YourBureau\Api\ClientConfig;
use YourBureau\Api\Http\Response;
use YourBureau\Api\Http\TransportInterface;

final class CrudResourceTest extends TestCase
{


	public function testUpdateUsesPatch(): void
	{
		$transport = $this->recordingTransport(200, ['id' => 7]);
		$client = new Client(new ClientConfig(apiKey: 'test-key', tenant: 'indual'), $transport);

		$client->customers()->update(7, ['name' => 'Acme']);

		$this->assertSame('PATCH', $transport->lastMethod);
		$this->assertStringContainsString('/api/v3/customers/7', $transport->lastUrl);
		$this->assertSame(['name' => 'Acme'], $transport->lastBody);
	}



	public function testDeleteUsesDelete(): void
	{
		$transport = $this->recordingTransport(200, []);
		$client = new Client(new ClientConfig(apiKey: 'test-key', tenant: 'indual'), $transport);

		$client->contacts()->delete(12);

		$this->assertSame('DELETE', $transport->lastMethod);
		$this->assertStringContainsString('/api/v3/contacts/12', $transport->lastUrl);
	}



	public function testRequestRawReturnsBinaryBody(): void
	{
		$transport = new class implements TransportInterface {
			public function request(
				string $method,
				string $url,
				array $headers = [],
				?array $jsonBody = null,
			): Response {
				return new Response(200, '%PDF-1.4 binary', ['content-type' => ['application/pdf']]);
			}
		};

		$client = new Client(new ClientConfig(apiKey: 'test-key', tenant: 'indual'), $transport);
		$response = $client->outgoings()->downloadPdfContent(99);

		$this->assertSame(200, $response->statusCode);
		$this->assertSame('%PDF-1.4 binary', $response->body);
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function recordingTransport(int $status, array $body): object
	{
		return new class ($status, $body) implements TransportInterface {
			public string $lastMethod = '';

			public string $lastUrl = '';

			/** @var array<string, mixed>|null */
			public ?array $lastBody = null;

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
				$this->lastMethod = $method;
				$this->lastUrl = $url;
				$this->lastBody = $jsonBody;

				return new Response($this->status, json_encode($this->body, JSON_THROW_ON_ERROR));
			}
		};
	}
}
