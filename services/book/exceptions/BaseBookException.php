<?php

declare(strict_types=1);

namespace app\services\book\exceptions;

use Exception;

/**
 * Базовое исключение для проблем с книгой
 */
abstract class BaseBookException extends Exception
{
    public function __construct(string $message = "", int $code = 422)
    {
        parent::__construct($message, $code, null);
    }
}