<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Orders API resource (`/api/v3/orders`).
 */
final class Orders extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/orders';
	}



	/**
	 * Get one order by numeric order_id or public MD5 hash.
	 *
	 * @return array<string, mixed>
	 */
	public function get(int|string $orderId): array
	{
		return $this->httpGet($this->path() . '/' . rawurlencode((string) $orderId));
	}



	/**
	 * Create an order. Payload must include `customer_id` and `articles`.
	 *
	 * @param array<string, mixed> $payload
	 * @return array{id: int, public_order_id: ?string, data: array<string, mixed>}
	 */
	public function create(array $payload): array
	{
		$response = $this->httpPost($this->path(), $payload);
		$id = $this->mutationId($response);
		$publicOrderId = $response['public_order_id'] ?? ($response['data']['public_order_id'] ?? null);

		return [
			'id' => $id,
			'public_order_id' => is_string($publicOrderId) && $publicOrderId !== '' ? $publicOrderId : null,
			'data' => is_array($response['data'] ?? null) ? $response['data'] : [],
		];
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function addArticles(int $orderId, array $payload): array
	{
		return $this->httpPost($this->path() . '/' . $orderId . '/articles', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function convertToInvoice(int $orderId, array $payload = []): array
	{
		return $this->httpPost($this->path() . '/' . $orderId . '/convert-to-invoice', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function sendEmail(int $orderId, array $payload = []): array
	{
		return $this->httpPost($this->path() . '/' . $orderId . '/send-email', $payload);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	public function timeReportPositions(int $orderId, array $query = []): array
	{
		return $this->httpGet($this->path() . '/' . $orderId . '/time-report-positions', $query);
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
