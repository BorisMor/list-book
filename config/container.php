<?php

declare(strict_types=1);

use app\services\author;
use app\services\book;
use app\services\report;
use app\services\subscription;

/**
 * Классы DI
 */

return [
    author\AuthorServiceInterface::class                           => author\AuthorService::class,
    author\repository\AuthorRepositoryInterface::class             => author\repository\AuthorRepository::class,
    book\BookServiceInterface::class                               => book\BookService::class,
    book\repository\BookRepositoryInterface::class                 => book\repository\BookRepository::class,
    book\repository\BookCoverRepositoryInterface::class            => book\repository\BookCoverRepository::class,
    subscription\SubscriptionServiceInterface::class               => subscription\SubscriptionService::class,
    subscription\repository\SubscriptionRepositoryInterface::class => subscription\repository\SubscriptionRepository::class,
    report\ReportServiceInterface::class                           => report\ReportService::class,
    report\repository\ReportRepositoryInterface::class             => report\repository\ReportRepository::class,
];