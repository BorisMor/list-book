<?php

declare(strict_types=1);

namespace app\services\report\factory;

use app\services\report\dtos\SettingsTopAuthorDto;

/**
 * Фабрика для {@see SettingsTopAuthorDto}
 */
class SettingsTopAuthorDtoFactory
{
    public static function create(int $count, int $year): SettingsTopAuthorDto
    {
        return new SettingsTopAuthorDto($count, $year);
    }
}