<?php

declare(strict_types=1);

namespace app\services\author;

use app\services\author\dtos\AuthorDto;
use app\services\author\dtos\CreateAuthorDto;
use app\services\author\exceptions\NotFoundAuthorException;
use app\services\author\repository\AuthorRepositoryInterface;
use app\services\author\factory\AuthorDtoFactory;
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
        $converter = new AuthorDtoFactory();

        return $this->repository->getDataProvider($page, $pageSize, $converter);
    }

    /**
     * @inheritDoc
     */
    public function create(CreateAuthorDto $dto): AuthorDto
    {
        try {
            return $this->repository->findByFullName($dto->getTitle());
        } catch (NotFoundAuthorException $e) {
            return $this->repository->create($dto);
        }
    }

    /**
     * @inheritDoc
     */
    public function getDirectory(): array
    {
        static $result;

        if (is_null($result)) {
            $result = $this->repository->getDirectory();
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $authorId): AuthorDto
    {
        return $this->repository->findById($authorId);
    }
}