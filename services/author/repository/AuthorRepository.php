<?php

declare(strict_types=1);

namespace app\services\author\repository;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\common\components\data\ActiveDataDTOProvider;
use app\services\author\ars\Author;
use app\services\author\dtos\AuthorDto;
use app\services\author\dtos\CreateAuthorDto;
use app\services\author\exceptions\CreateAuthorException;
use app\services\author\exceptions\NotFoundAuthorException;
use app\services\author\factory\AuthorDtoFactory;
use yii\data\DataProviderInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getDataProvider(int $page, int $pageSize, ActiveDataDTOFactoryInterface $factory): DataProviderInterface
    {
        $query = Author::find();

        return new ActiveDataDTOProvider([
            'converter'  => $factory,
            'query'      => $query,
            'pagination' => [
                'pageSize' => $pageSize ?: false,
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function create(CreateAuthorDto $dto): AuthorDto
    {
        $model        = new Author();
        $model->title = $dto->getTitle();

        if (!$model->save()) {
            throw new CreateAuthorException($model->errors);
        }

        return AuthorDtoFactory::createFromActiveRecord($model);
    }

    /**
     * @inheritDoc
     */
    public function findByFullName(string $name): AuthorDto
    {
        /** @var Author|null $ar */
        $ar = Author::find()->where([Author::ATTR_TITLE => $name])->one();

        if (!$ar) {
            throw new NotFoundAuthorException($name);
        }

        return AuthorDtoFactory::createFromActiveRecord($ar);
    }

    /**
     * @inheritDoc
     */
    public function getDirectory(): array
    {
        return Author::find()
            ->select(Author::ATTR_TITLE)
            ->indexBy(Author::ATTR_ID)
            ->column();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $authorId): AuthorDto
    {
        /** @var Author|null $ar */
        $ar = Author::findOne($authorId);

        if (!$ar) {
            throw new NotFoundAuthorException('#'.$authorId);
        }

        return AuthorDtoFactory::createFromActiveRecord($ar);
    }
}