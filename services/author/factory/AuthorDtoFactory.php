<?php

declare(strict_types=1);

namespace app\services\author\factory;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\services\author\ars\Author;
use app\services\author\dtos\AuthorDto;

/**
 * Фабрика для {@see AuthorDto}
 */
class AuthorDtoFactory implements ActiveDataDTOFactoryInterface
{

    /**
     * @param int    $id
     * @param string $title
     *
     * @return AuthorDto
     */
    public static function create(int $id, string $title): AuthorDto
    {
        return new AuthorDto($id, $title);
    }

    /**
     * Создать на основе ActiveRecord
     *
     * @param Author $ar
     *
     * @return AuthorDto
     */
    public static function createFromActiveRecord(Author $ar): AuthorDto
    {
        return static::create($ar->id, $ar->title);
    }

    /**
     * @inheritDoc
     */
    public static function createFromActiveRecords(array $activeRecordModels): array
    {
        $dtos = [];

        foreach ($activeRecordModels as $ar) {
            $dto = self::createFromActiveRecord($ar);

            if ($dto) {
                $dtos[] = $dto;
            }
        }

        return $dtos;
    }
}