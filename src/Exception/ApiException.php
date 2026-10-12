<?php

declare(strict_types=1);

namespace YourBureau\Api\Exception;

/**
 * Base exception for yourBureau API errors.
 */
class ApiException extends \RuntimeException
{


	/**
	 * @param array<string, mixed>|null $responseBody
	 */
	public function __construct(
		string $message,
		private readonly int $statusCode = 0,
		private readonly ?array $responseBody = null,
		?\Throwable $previous = null,
	) {
		parent::__construct($message, $statusCode, $previous);
	}



	public function getStatusCode(): int
	{
		return $this->statusCode;
	}



	/**
	 * @return array<string, mixed>|null
	 */
	public function getResponseBody(): ?array
	{
		return $this->responseBody;
	}
}
