<?php

declare(strict_types=1);

namespace app\services\subscription\exceptions;

use Exception;
use Yii;

class ExistSubscriptionException extends Exception
{
    public function __construct()
    {
        parent::__construct(Yii::t('app', 'Подписка уже существует'));
    }
}