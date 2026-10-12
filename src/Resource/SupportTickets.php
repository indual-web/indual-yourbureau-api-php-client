<?php

declare(strict_types=1);

namespace YourBureau\Api\Resource;

/**
 * Support tickets API resource (`/api/v3/support-tickets`).
 */
final class SupportTickets extends CrudResource
{


	protected function path(): string
	{
		return '/api/v3/support-tickets';
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function assignToUser(int $supportTicketId, array $payload): array
	{
		return $this->httpPost($this->path() . '/' . $supportTicketId . '/assign-to-user', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function answer(int $supportTicketId, array $payload): array
	{
		return $this->httpPost($this->path() . '/' . $supportTicketId . '/answer', $payload);
	}



	/**
	 * @param array<string, mixed> $payload
	 * @return array<string, mixed>
	 */
	public function setToDone(int $supportTicketId, array $payload = []): array
	{
		return $this->httpPost($this->path() . '/' . $supportTicketId . '/set-to-done', $payload);
	}
}
