<?php

declare(strict_types=1);

namespace app\services\subscription\repository;

use app\services\subscription\ars\SubscriptionAuthor;
use app\services\subscription\ars\SubscriptionNotification;
use app\services\subscription\exceptions\CreateSubscriptionException;
use app\services\subscription\exceptions\ExistSubscriptionException;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function registerEmail(string $email): int
    {
        $ar = SubscriptionNotification::find()->where([SubscriptionNotification::ATTR_EMAIL => $email])->one();

        if (!$ar) {
            $ar        = new SubscriptionNotification();
            $ar->email = $email;

            if (!$ar->save()) {
                throw new CreateSubscriptionException($ar->getErrors());
            }
        }

        return $ar->id;
    }

    /**
     * @inheritDoc
     */
    public function subscriptionAuthor(int $authorId, int $notificationId)
    {
        $ar = SubscriptionAuthor::find()->where([
            SubscriptionAuthor::ATTR_AUTHOR_ID       => $authorId,
            SubscriptionAuthor::ATTR_NOTIFICATION_ID => $notificationId,
        ])->one();

        if ($ar) {
            throw new ExistSubscriptionException();
        }

        $ar                  = new SubscriptionAuthor();
        $ar->author_id       = $authorId;
        $ar->notification_id = $notificationId;

        if (!$ar->save()) {
            throw new CreateSubscriptionException($ar->getErrors());
        }
    }
}

