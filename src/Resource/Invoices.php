<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Pagination\Page;

/**
 * Invoices API resource (`/api/v3/invoices`).
 */
final class Invoices extends AbstractResource
{


	private const PATH = '/api/v3/invoices';


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
	 * Get one invoice by numeric invoice_id or public MD5 hash.
	 *
	 * @return array<string, mixed>
	 */
	public function get(int|string $invoiceId): array
	{
		return $this->httpGet(self::PATH . '/' . rawurlencode((string) $invoiceId));
	}



	/**
	 * Create an invoice. Payload must include `customer_id` and `articles`.
	 *
	 * @param array<string, mixed> $payload
	 * @return array{id: int, public_invoice_id: ?string, data: array<string, mixed>}
	 */
	public function create(array $payload): array
	{
		$response = $this->httpPost(self::PATH, $payload);
		$id = $this->mutationId($response);
		$publicInvoiceId = $response['public_invoice_id'] ?? ($response['data']['public_invoice_id'] ?? null);

		return [
			'id' => $id,
			'public_invoice_id' => is_string($publicInvoiceId) && $publicInvoiceId !== '' ? $publicInvoiceId : null,
			'data' => is_array($response['data'] ?? null) ? $response['data'] : [],
		];
	}



	/**
	 * Partial update via PATCH (same semantics as PUT in API v3).
	 *
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function update(int|string $invoiceId, array $payload): array
	{
		return $this->httpPatch(self::PATH . '/' . rawurlencode((string) $invoiceId), $payload);
	}



	public function delete(int|string $invoiceId): void
	{
		$this->httpDelete(self::PATH . '/' . rawurlencode((string) $invoiceId));
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function addArticles(int|string $invoiceId, array $payload): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $invoiceId) . '/articles', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function sendEmail(int|string $invoiceId, array $payload = []): array
	{
		return $this->httpPost(self::PATH . '/' . rawurlencode((string) $invoiceId) . '/send-email', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function changeState(array $payload): array
	{
		return $this->httpPatch('/api/v3/invoices-state', $payload);
	}



	/**
	 * List payments for one invoice (`invoice_id` required). Returns a JSON array.
	 *
	 * @param array<string, scalar|null> $query
	 * @return list<array<string, mixed>>
	 */
	public function listPayments(array $query): array
	{
		$response = $this->client->request('GET', '/api/v3/invoices-payment', $query);
		if ($response === []) {
			return [];
		}

		$rows = array_is_list($response) ? $response : ($response['data'] ?? []);
		if (! is_array($rows)) {
			return [];
		}

		/** @var list<array<string, mixed>> $list */
		$list = array_values(array_filter($rows, 'is_array'));

		return $list;
	}



	/**
	 * @param array<string, mixed> $payload
	 */
	public function addPayment(array $payload): int
	{
		return $this->mutationId($this->httpPost('/api/v3/invoices-payment', $payload));
	}
}
