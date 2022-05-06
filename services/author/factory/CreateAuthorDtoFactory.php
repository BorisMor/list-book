<?php

declare(strict_types=1);

namespace app\services\author\factory;

use app\models\author\CreateAuthorForm;
use app\services\author\dtos\CreateAuthorDto;

/**
 * Фабрика для {@see CreateAuthorDto}
 */
class CreateAuthorDtoFactory
{
    public static function create(string $title): CreateAuthorDto
    {
        return new CreateAuthorDto($title);
    }

    /**
     * Создать на основе формы
     *
     * @param CreateAuthorForm $modelForm
     *
     * @return CreateAuthorDto
     */
    public static function craeteFromForm(CreateAuthorForm $modelForm)
    {
        return static::create($modelForm->title);
    }
}