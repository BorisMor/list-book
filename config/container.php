<?php

declare(strict_types=1);

use app\services\author;

/**
 * Классы DI
 */

return [
    author\AuthorServiceInterface::class               => author\AuthorService::class,
    author\repository\AuthorRepositoryInterface::class => author\repository\AuthorRepository::class,
];