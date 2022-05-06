<?php

declare(strict_types=1);

namespace app\services\author\exceptions;

use Yii;

class NotFoundAuthorException extends BaseAuthorException
{
    public function __construct(string $find)
    {
        parent::__construct(Yii::t('app', 'Автор не найден ({find})', ['find' => $find]), 404);
    }
}