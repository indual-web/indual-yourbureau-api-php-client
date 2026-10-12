<?php

declare(strict_types=1);

namespace YourBureau\Api\Http;

/**
 * HTTP transport used by the API client.
 */
interface TransportInterface
{


	/**
	 * Send an HTTP request and return the response.
	 *
	 * @param array<string, string> $headers
	 * @param array<string, mixed>|null $jsonBody
	 */
	public function request(
		string $method,
		string $url,
		array $headers = [],
		?array $jsonBody = null,
	): Response;
}
