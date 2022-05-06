<?php

declare(strict_types=1);

namespace app\services\subscription\exceptions;

use Exception;

/**
 * Базовое исключение для проблем с подпиской
 */
abstract class BaseSubscriptionException extends Exception
{
    public function __construct(string $message = "", int $code = 422)
    {
        parent::__construct($message, $code, null);
    }
}