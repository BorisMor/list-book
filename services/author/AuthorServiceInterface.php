<?php

declare(strict_types=1);

namespace app\services\author;

use yii\data\DataProviderInterface;

interface AuthorServiceInterface
{
    /**
     * Получить список авторов
     *
     * @param int $page     Номер страницы
     * @param int $pageSize Размер страницы
     *
     * @return \yii\data\DataProviderInterface
     */
    public function getDataProvider(int $page = 0, int $pageSize = 50): DataProviderInterface;
}