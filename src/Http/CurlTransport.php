<?php

declare(strict_types=1);

namespace YourBureau\Api\Http;

use YourBureau\Api\ClientConfig;
use YourBureau\Api\Exception\TransportException;

/**
 * cURL-based HTTP transport.
 */
final class CurlTransport implements TransportInterface
{


	public function __construct(
		private readonly ClientConfig $config,
	) {
	}



	/**
	 * @inheritDoc
	 */
	public function request(
		string $method,
		string $url,
		array $headers = [],
		?array $jsonBody = null,
	): Response {
		$curl = curl_init($url);

		if ($curl === false) {
			throw new TransportException('Unable to initialize cURL.');
		}

		$headerLines = [];
		foreach ($headers as $name => $value) {
			$headerLines[] = $name . ': ' . $value;
		}

		$options = [
			CURLOPT_CUSTOMREQUEST => strtoupper($method),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => true,
			CURLOPT_CONNECTTIMEOUT => $this->config->connectTimeoutSeconds,
			CURLOPT_TIMEOUT => $this->config->timeoutSeconds,
			CURLOPT_SSL_VERIFYPEER => $this->config->verifySsl,
			CURLOPT_SSL_VERIFYHOST => $this->config->verifySsl ? 2 : 0,
			CURLOPT_HTTPHEADER => $headerLines,
		];

		if ($jsonBody !== null) {
			$encoded = json_encode($jsonBody, JSON_THROW_ON_ERROR);
			$options[CURLOPT_POSTFIELDS] = $encoded;
		}

		curl_setopt_array($curl, $options);

		$raw = curl_exec($curl);

		if ($raw === false) {
			$error = curl_error($curl);
			$code = curl_errno($curl);
			throw new TransportException('cURL request failed: ' . $error, $code);
		}

		$statusCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$headerSize = (int) curl_getinfo($curl, CURLINFO_HEADER_SIZE);

		$headerBlob = substr($raw, 0, $headerSize);
		$body = substr($raw, $headerSize);

		return new Response($statusCode, $body === false ? '' : $body, $this->parseHeaders($headerBlob));
	}



	/**
	 * @return array<string, list<string>>
	 */
	private function parseHeaders(string $headerBlob): array
	{
		$headers = [];
		$lines = preg_split('/\r\n|\n|\r/', $headerBlob) ?: [];

		foreach ($lines as $line) {
			if ($line === '' || ! str_contains($line, ':')) {
				continue;
			}

			[$name, $value] = explode(':', $line, 2);
			$name = strtolower(trim($name));
			$headers[$name][] = trim($value);
		}

		return $headers;
	}
}
