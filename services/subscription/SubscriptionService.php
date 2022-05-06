<?php

declare(strict_types=1);

namespace app\services\subscription;

use app\services\subscription\repository\SubscriptionRepositoryInterface;

class SubscriptionService implements SubscriptionServiceInterface
{
    /**
     * @var \app\services\subscription\repository\SubscriptionRepositoryInterface
     */
    private SubscriptionRepositoryInterface $repository;

    public function __construct(SubscriptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function onAuthorByEmail(int $authorId, string $email): void
    {
        $notificationId = $this->repository->registerEmail($email);
        $this->repository->subscriptionAuthor($authorId, $notificationId);
    }
}