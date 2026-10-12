<?php

declare(strict_types=1);

namespace YourBureau\Api\Pagination;

/**
 * One page of a paginated list response.
 */
final class Page
{


	/**
	 * @param list<array<string, mixed>> $data
	 * @param array<string, mixed> $meta
	 */
	public function __construct(
		public readonly array $data,
		public readonly array $meta = [],
	) {
	}



	public function total(): ?int
	{
		$value = $this->meta['total'] ?? null;

		return is_numeric($value) ? (int) $value : null;
	}



	public function limit(): int
	{
		$value = $this->meta['limit'] ?? count($this->data);

		return is_numeric($value) ? (int) $value : count($this->data);
	}



	public function offset(): int
	{
		$value = $this->meta['offset'] ?? 0;

		return is_numeric($value) ? (int) $value : 0;
	}



	public function hasMore(): bool
	{
		$total = $this->total();
		if ($total === null) {
			return count($this->data) >= $this->limit() && $this->limit() > 0;
		}

		return ($this->offset() + count($this->data)) < $total;
	}
}
