<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Orders API resource (`/api/v3/orders`).
 */
final class Orders extends AbstractResource
{


	private const PATH = '/api/v3/orders';


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
	 * Get one order by numeric order_id or public MD5 hash.
	 *
	 * @return array<string, mixed>
	 */
	public function get(int|string $orderId): array
	{
		return $this->httpGet(self::PATH . '/' . rawurlencode((string) $orderId));
	}



	/**
	 * Create an order. Payload must include `customer_id` and `articles`.
	 *
	 * @param array<string, mixed> $payload
	 * @return array{id: int, public_order_id: ?string, data: array<string, mixed>}
	 */
	public function create(array $payload): array
	{
		$response = $this->httpPost(self::PATH, $payload);
		$id = $this->mutationId($response);
		$publicOrderId = $response['public_order_id'] ?? ($response['data']['public_order_id'] ?? null);

		return [
			'id' => $id,
			'public_order_id' => is_string($publicOrderId) && $publicOrderId !== '' ? $publicOrderId : null,
			'data' => is_array($response['data'] ?? null) ? $response['data'] : [],
		];
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function update(int|string $orderId, array $payload): array
	{
		return $this->httpPatch(self::PATH . '/' . rawurlencode((string) $orderId), $payload);
	}



	public function delete(int|string $orderId): void
	{
		$this->httpDelete(self::PATH . '/' . rawurlencode((string) $orderId));
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function addArticles(int|string $orderId, array $payload): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $orderId) . '/articles', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function convertToInvoice(int|string $orderId, array $payload = []): array
	{
		return $this->httpPost(
			self::PATH . '/' . rawurlencode((string) $orderId) . '/convert-to-invoice',
			$payload,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function sendEmail(int|string $orderId, array $payload = []): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $orderId) . '/send-email', $payload);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	public function timeReportPositions(int|string $orderId, array $query = []): array
	{
		return $this->httpGet(
			self::PATH . '/' . rawurlencode((string) $orderId) . '/time-report-positions',
			$query,
		);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function changeState(array $payload): array
	{
		return $this->httpPatch('/api/v3/orders-state', $payload);
	}
}
