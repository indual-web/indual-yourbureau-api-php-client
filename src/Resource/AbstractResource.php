<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

use YourBureau\Api\Client;
use YourBureau\Api\Pagination\Page;

/**
 * Shared helpers for API resource classes.
 */
abstract class AbstractResource
{


	public function __construct(
		protected readonly Client $client,
	) {
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	protected function httpGet(string $path, array $query = []): array
	{
		return $this->client->request('GET', $path, $query);
	}



	/**
	 * @param array<string, mixed> $body
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	protected function httpPost(string $path, array $body = [], array $query = []): array
	{
		return $this->client->request('POST', $path, $query, $body);
	}



	/**
	 * @param array<string, mixed> $body
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	protected function httpPut(string $path, array $body = [], array $query = []): array
	{
		return $this->client->request('PUT', $path, $query, $body);
	}



	/**
	 * @param array<string, mixed> $body
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	protected function httpPatch(string $path, array $body = [], array $query = []): array
	{
		return $this->client->request('PATCH', $path, $query, $body);
	}



	/**
	 * @param array<string, scalar|null> $query
	 * @return array<string, mixed>
	 */
	protected function httpDelete(string $path, array $query = []): array
	{
		return $this->client->request('DELETE', $path, $query);
	}



	/**
	 * @param array<string, scalar|null> $query
	 */
	protected function listPage(string $path, array $query = []): Page
	{
		$response = $this->httpGet($path, $query);
		$data = $response['data'] ?? [];
		$meta = $response['meta'] ?? [];

		if (! is_array($data)) {
			$data = [];
		}

		/** @var list<array<string, mixed>> $rows */
		$rows = array_values(array_filter($data, 'is_array'));

		return new Page($rows, is_array($meta) ? $meta : []);
	}



	/**
	 * Fetch all pages and return a flat list of rows.
	 *
	 * @param array<string, scalar|null> $query
	 * @return list<array<string, mixed>>
	 */
	protected function listAllPages(string $path, array $query = [], int $maxPages = 1000): array
	{
		$limit = isset($query['limit']) ? (int) $query['limit'] : 100;
		if ($limit < 1) {
			$limit = 100;
		}
		if ($limit > 1000) {
			$limit = 1000;
		}

		$query['limit'] = $limit;
		$offset = isset($query['offset']) ? (int) $query['offset'] : 0;
		$all = [];

		for ($page = 0; $page < $maxPages; $page++) {
			$query['offset'] = $offset;
			$result = $this->listPage($path, $query);
			$all = array_merge($all, $result->data);

			if (! $result->hasMore() || $result->data === []) {
				break;
			}

			$offset += $result->limit() > 0 ? $result->limit() : $limit;
		}

		return $all;
	}



	/**
	 * Extract the created/updated record id from a mutation response.
	 *
	 * @param array<string, mixed> $response
	 */
	protected function mutationId(array $response): int
	{
		$id = $response['id'] ?? null;
		if (! is_numeric($id)) {
			throw new \RuntimeException('Mutation response did not contain a numeric id.');
		}

		return (int) $id;
	}
}
