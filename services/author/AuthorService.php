<?php

declare(strict_types=1);

namespace app\services\author;

use app\services\author\repository\AuthorRepositoryInterface;
use app\services\author\repository\factory\AuthorInfoDtoFactory;
use yii\data\DataProviderInterface;

class AuthorService implements AuthorServiceInterface
{
    /**
     * @var \app\services\author\repository\AuthorRepositoryInterface
     */
    private AuthorRepositoryInterface $repository;

    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getDataProvider(int $page = 0, int $pageSize = 50): DataProviderInterface
    {
        $converter = new AuthorInfoDtoFactory();

        return $this->repository->getDataProvider($page, $pageSize, $converter);
    }
}