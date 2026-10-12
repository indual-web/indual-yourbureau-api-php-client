<?php

declare(strict_types=1);

namespace YourBureau\Api\Exception;

/**
 * Thrown when the API rate limit is exceeded (429).
 */
final class RateLimitException extends ApiException
{
}
