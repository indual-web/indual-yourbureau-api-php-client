<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Invoices API resource (`/api/v3/invoices`).
 */
final class Invoices extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/invoices';
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function addArticles(int $invoiceId, array $payload): array
	{
		return $this->httpPost($this->path() . '/' . $invoiceId . '/articles', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function sendEmail(int $invoiceId, array $payload = []): array
	{
		return $this->httpPost($this->path() . '/' . $invoiceId . '/send-email', $payload);
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
