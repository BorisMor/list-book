<?php

declare(strict_types=1);

namespace app\services\author\repository\factory;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\services\author\dtos\AuthorInfoDto;
use yii\db\ActiveRecord;

/**
 * Фабрика для {@see AuthorInfoDto}
 */
class AuthorInfoDtoFactory implements ActiveDataDTOFactoryInterface
{

    /**
     * @param int    $id
     * @param string $title
     *
     * @return AuthorInfoDto
     */
    public function create(int $id, string $title): AuthorInfoDto
    {
        return new AuthorInfoDto($id, $title);
    }

    public function createFromActiveRecord(): AuthorInfoDto
    {

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