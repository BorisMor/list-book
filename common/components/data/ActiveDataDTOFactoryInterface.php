<?php

declare(strict_types=1);

namespace app\common\components\data;

use yii\db\ActiveRecord;

/**
 * Интерфейс фабрики для Active Data DTO провайдера, которая создает массив DTO на основе массива Active Record моделей
 */
interface ActiveDataDTOFactoryInterface
{
    /**
     * Создать массив DTO из нескольких Active Record
     *
     * @param ActiveRecord[] $activeRecordModels
     *
     * @return object[]
     */
    public static function createFromActiveRecords(array $activeRecordModels): array;
}