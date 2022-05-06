<?php

declare(strict_types=1);

namespace app\services\report\factory;

use app\services\report\dtos\ItemTopAuthorDto;

/**
 * Фабрика для {@see ItemTopAuthorDto}
 */
class ItemTopAuthorDtoFactory
{
    public static function create(string $title, int $authorId, int $countBook): ItemTopAuthorDto
    {
        return new ItemTopAuthorDto($title, $authorId, $countBook);
    }
}