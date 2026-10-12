<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Offers API resource (`/api/v3/offers`).
 */
final class Offers extends AbstractResource
{


	private const PATH = '/api/v3/offers';


	/**
	 * @param array<string, scalar|null> $query
	 */
	public function list(array $query = []): Page
	{
		return $this->listPage(self::PATH, $query);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return list<array<string, mixed>>
	 */
	public function listAll(array $query = []): array
	{
		return $this->listAllPages(self::PATH, $query);
	}



	/**
	 * Get one offer by numeric offer_id or public MD5 hash.
	 *
	 * @return array<string, mixed>
	 */
	public function get(int|string $offerId): array
	{
		return $this->httpGet(self::PATH . '/' . rawurlencode((string) $offerId));
	}



	/**
	 * Create an offer. Payload must include `customer_id` and `articles`.
	 *
	 * @param array<string, mixed> $payload
	 * @return array{id: int, public_offer_id: ?string, data: array<string, mixed>}
	 */
	public function create(array $payload): array
	{
		$response = $this->httpPost(self::PATH, $payload);
		$id = $this->mutationId($response);
		$publicOfferId = $response['public_offer_id'] ?? ($response['data']['public_offer_id'] ?? null);

		return [
			'id' => $id,
			'public_offer_id' => is_string($publicOfferId) && $publicOfferId !== '' ? $publicOfferId : null,
			'data' => is_array($response['data'] ?? null) ? $response['data'] : [],
		];
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function update(int|string $offerId, array $payload): array
	{
		return $this->httpPatch(self::PATH . '/' . rawurlencode((string) $offerId), $payload);
	}



	public function delete(int|string $offerId): void
	{
		$this->httpDelete(self::PATH . '/' . rawurlencode((string) $offerId));
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function addArticles(int|string $offerId, array $payload): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $offerId) . '/articles', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function convertToOrder(int|string $offerId, array $payload = []): array
	{
		return $this->httpPost(
			self::PATH . '/' . rawurlencode((string) $offerId) . '/convert-to-order',
			$payload,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function sendEmail(int|string $offerId, array $payload = []): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $offerId) . '/send-email', $payload);
	}


	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function changeState(array $payload): array
	{
		return $this->httpPatch('/api/v3/offers-state', $payload);
	}
}
