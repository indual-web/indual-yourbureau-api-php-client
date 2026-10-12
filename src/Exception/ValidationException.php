<?php

declare(strict_types=1);

namespace YourBureau\Api\Exception;

/**
 * Thrown when the API rejects the request payload (400/422).
 */
final class ValidationException extends ApiException
{


	/**
	 * @return array<string, mixed>
	 */
	public function getMessages(): array
	{
		$body = $this->getResponseBody() ?? [];
		$messages = $body['messages'] ?? [];

		return is_array($messages) ? $messages : [];
	}
}
