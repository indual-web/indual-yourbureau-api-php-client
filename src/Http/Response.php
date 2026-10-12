<?php

declare(strict_types=1);

namespace YourBureau\Api\Http;

/**
 * Raw HTTP response from the transport layer.
 */
final class Response
{


	/**
	 * @param array<string, list<string>> $headers
	 */
	public function __construct(
		public readonly int $statusCode,
		public readonly string $body,
		public readonly array $headers = [],
	) {
	}



	/**
	 * Decode the JSON body as an associative array.
	 *
	 * @return array<string, mixed>|list<mixed>
	 */
	public function json(): array
	{
		if ($this->body === '') {
			return [];
		}

		$decoded = json_decode($this->body, true);

		if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
			throw new \RuntimeException('Response body is not valid JSON: ' . json_last_error_msg());
		}

		return $decoded;
	}
}
