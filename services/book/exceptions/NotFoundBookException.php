<?php

declare(strict_types=1);

namespace app\services\book\exceptions;

use Yii;

class NotFoundBookException extends BaseBookException
{
    public function __construct(string $find)
    {
        parent::__construct(Yii::t('app', 'Книга не найдена ({find})', ['find' => $find]), 404);
    }
}