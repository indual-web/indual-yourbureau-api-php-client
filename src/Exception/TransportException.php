<?php

declare(strict_types=1);

namespace YourBureau\Api\Exception;

/**
 * Thrown when the HTTP transport itself fails (network, cURL, …).
 */
final class TransportException extends ApiException
{
}
