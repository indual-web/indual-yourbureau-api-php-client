<?php

declare(strict_types=1);

namespace YourBureau\Api;

use YourBureau\Api\Exception\ApiException;
use YourBureau\Api\Exception\AuthenticationException;
use YourBureau\Api\Exception\NotFoundException;
use YourBureau\Api\Exception\RateLimitException;
use YourBureau\Api\Exception\TransportException;
use YourBureau\Api\Exception\ValidationException;
use YourBureau\Api\Http\CurlTransport;
use YourBureau\Api\Http\TransportInterface;
use YourBureau\Api\Resource\Contacts;
use YourBureau\Api\Resource\CustomerContacts;
use YourBureau\Api\Resource\Customers;
use YourBureau\Api\Resource\Offers;
use YourBureau\Api\Resource\Orders;

/**
 * Entry point for the yourBureau REST API v3.
 */
final class Client
{


	private readonly TransportInterface $transport;

	private ?Customers $customers = null;

	private ?Contacts $contacts = null;

	private ?CustomerContacts $customerContacts = null;

	private ?Offers $offers = null;

	private ?Orders $orders = null;


	public function __construct(
		private readonly ClientConfig $config,
		?TransportInterface $transport = null,
	) {
		$this->transport = $transport ?? new CurlTransport($config);
	}



	public function config(): ClientConfig
	{
		return $this->config;
	}



	public function customers(): Customers
	{
		return $this->customers ??= new Customers($this);
	}



	public function contacts(): Contacts
	{
		return $this->contacts ??= new Contacts($this);
	}



	public function customerContacts(): CustomerContacts
	{
		return $this->customerContacts ??= new CustomerContacts($this);
	}



	public function offers(): Offers
	{
		return $this->offers ??= new Offers($this);
	}



	public function orders(): Orders
	{
		return $this->orders ??= new Orders($this);
	}



	/**
	 * Perform a raw API request.
	 *
	 * @param array<string, scalar|null> $query
	 * @param array<string, mixed>|null $jsonBody
	 * @return array<string, mixed>
	 */
	public function request(
		string $method,
		string $path,
		array $query = [],
		?array $jsonBody = null,
	): array {
		$url = $this->config->normalizedBaseUrl() . '/' . ltrim($path, '/');

		$filteredQuery = [];
		foreach ($query as $key => $value) {
			if ($value === null) {
				continue;
			}
			$filteredQuery[$key] = $value;
		}

		if ($filteredQuery !== []) {
			$url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($filteredQuery);
		}

		$headers = [
			'Accept' => 'application/json',
			'X-Tenant' => $this->config->tenant,
			'X-API-Key' => $this->config->apiKey,
		];

		if ($this->config->userAgent !== null && $this->config->userAgent !== '') {
			$headers['User-Agent'] = $this->config->userAgent;
		}

		if ($jsonBody !== null) {
			$headers['Content-Type'] = 'application/json';
		}

		try {
			$response = $this->transport->request($method, $url, $headers, $jsonBody);
		} catch (TransportException $e) {
			throw $e;
		} catch (\Throwable $e) {
			throw new TransportException($e->getMessage(), 0, null, $e);
		}

		$body = [];
		if ($response->body !== '') {
			try {
				$decoded = $response->json();
				$body = is_array($decoded) ? $decoded : [];
			} catch (\Throwable $e) {
				if ($response->statusCode >= 400) {
					throw $this->mapError($response->statusCode, ['error' => $response->body], $e);
				}
				throw new ApiException('Invalid JSON response: ' . $e->getMessage(), $response->statusCode, null, $e);
			}
		}

		if ($response->statusCode >= 400) {
			throw $this->mapError($response->statusCode, $body);
		}

		/** @var array<string, mixed> $body */
		return $body;
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function mapError(int $statusCode, array $body, ?\Throwable $previous = null): ApiException
	{
		$message = $this->extractErrorMessage($body) ?? ('HTTP ' . $statusCode);

		return match (true) {
			$statusCode === 401, $statusCode === 403 => new AuthenticationException($message, $statusCode, $body, $previous),
			$statusCode === 404 => new NotFoundException($message, $statusCode, $body, $previous),
			$statusCode === 400, $statusCode === 422 => new ValidationException($message, $statusCode, $body, $previous),
			$statusCode === 429 => new RateLimitException($message, $statusCode, $body, $previous),
			default => new ApiException($message, $statusCode, $body, $previous),
		};
	}



	/**
	 * @param array<string, mixed> $body
	 */
	private function extractErrorMessage(array $body): ?string
	{
		if (isset($body['error']) && is_string($body['error']) && $body['error'] !== '') {
			return $body['error'];
		}

		if (isset($body['messages']) && is_array($body['messages'])) {
			$parts = [];
			foreach ($body['messages'] as $key => $value) {
				if (is_string($value)) {
					$parts[] = is_string($key) ? $key . ': ' . $value : $value;
				} elseif (is_array($value)) {
					$parts[] = is_string($key) ? $key . ': ' . implode(', ', array_map('strval', $value)) : implode(', ', array_map('strval', $value));
				}
			}
			if ($parts !== []) {
				return implode('; ', $parts);
			}
		}

		if (isset($body['message']) && is_string($body['message']) && $body['message'] !== '') {
			return $body['message'];
		}

		return null;
	}
}
