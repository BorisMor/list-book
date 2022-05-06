<?php

declare(strict_types=1);

namespace app\services\author\exceptions;

use Exception;


/**
 * Базовое исключение для проблем с автором
 */
abstract class BaseAuthorException extends Exception
{
    public function __construct(string $message = "", int $code = 422)
    {
        parent::__construct($message, $code, null);
    }
}