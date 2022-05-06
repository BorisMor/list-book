<?php

declare(strict_types=1);

namespace app\services\subscription\repository;

interface SubscriptionRepositoryInterface
{
    /**
     * Регистрируем email
     * Возвращает идентификатора оповещения
     *
     * @param string $email
     *
     * @return int
     */
    public function registerEmail(string $email): int;

    /**
     * Подписаться на автора
     *
     * @param int $authorId       Идентификатора автора
     * @param int $notificationId Идентификатора оповещения
     *
     * @return mixed
     */
    public function subscriptionAuthor(int $authorId, int $notificationId);
}