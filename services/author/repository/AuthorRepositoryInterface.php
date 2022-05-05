<?php

declare(strict_types=1);

namespace app\services\author\repository;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use yii\data\DataProviderInterface;

interface AuthorRepositoryInterface
{
    /**
     * Провайдер данных по
     *
     * @param int                           $page     Страница
     * @param int                           $pageSize Размер страницы
     * @param ActiveDataDTOFactoryInterface $factory  Фабрика в DTO
     *
     * @return DataProviderInterface
     */
    public function getDataProvider(int $page, int $pageSize, ActiveDataDTOFactoryInterface $factory): DataProviderInterface;
}