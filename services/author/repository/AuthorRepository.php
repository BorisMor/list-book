<?php

declare(strict_types=1);

namespace app\services\author\repository;

use yii\data\DataProviderInterface;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function getDataProvider(int $page = 0, int $pageSize = 50, ActiveDataDTOFactoryInterface $converter): DataProviderInterface
    {
        // TODO: Implement getDataProvider() method.
    }
}