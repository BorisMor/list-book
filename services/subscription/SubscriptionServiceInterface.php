<?php

declare(strict_types=1);

namespace app\services\subscription;

/**
 * Отвечает за подписку
 */
interface SubscriptionServiceInterface
{
    /**
     * Подписаться на автора по почте
     *
     * @param int    $authorId Автор
     * @param string $email    Почта
     */
    public function onAuthorByEmail(int $authorId, string $email): void;
}