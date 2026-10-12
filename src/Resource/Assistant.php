<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Assistant API resource (`/api/v3/assistant/...`).
 */
final class Assistant extends AbstractResource
{


	private const PATH = '/api/v3/assistant';


	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	public function infoQueryCatalog(array $query = []): array
	{
		return $this->httpGet(self::PATH . '/info-query/catalog', $query);
	}



	/**
	 * Execute an info query via GET.
	 *
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	public function infoQuery(array $query = []): array
	{
		return $this->httpGet(self::PATH . '/info-query', $query);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function createInfoQuery(array $payload): array
	{
		return $this->httpPost(self::PATH . '/info-query', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function createDocument(array $payload): array
	{
		return $this->httpPost(self::PATH . '/documents', $payload);
	}



	/**
	 * @return array<string, mixed>
	 */
	public function getDocument(string $type, int $id): array
	{
		return $this->httpGet(self::PATH . '/documents/' . rawurlencode($type) . '/' . $id);
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function updateDocument(string $type, int $id, array $payload): array
	{
		return $this->httpPatch(
			self::PATH . '/documents/' . rawurlencode($type) . '/' . $id,
			$payload,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function setDocumentCustomer(string $type, int $id, array $payload): array
	{
		return $this->httpPost(
			self::PATH . '/documents/' . rawurlencode($type) . '/' . $id . '/customer',
			$payload,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function setDocumentPositions(string $type, int $id, array $payload): array
	{
		return $this->httpPost(
			self::PATH . '/documents/' . rawurlencode($type) . '/' . $id . '/positions',
			$payload,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function finalizeDocument(string $type, int $id, array $payload = []): array
	{
		return $this->httpPost(
			self::PATH . '/documents/' . rawurlencode($type) . '/' . $id . '/finalize',
			$payload,
		);
	}
}
