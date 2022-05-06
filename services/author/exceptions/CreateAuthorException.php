<?php

declare(strict_types=1);

namespace app\services\author\exceptions;

use Yii;

class CreateAuthorException extends BaseAuthorException
{
    private array $errors;

    public function __construct(array $errors)
    {
        parent::__construct(Yii::t('app', 'Ошибка при создание автора'));
        $this->errors = $errors;
    }

    /**
     * Список ошибок при сохранение модели
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}