<?php

declare(strict_types=1);

namespace app\services\author\repository;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\services\author\dtos\AuthorDto;
use app\services\author\dtos\CreateAuthorDto;
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

    /**
     * Создать запись об авторе
     *
     * @param CreateAuthorDto $dto
     *
     * @return AuthorDto
     */
    public function create(CreateAuthorDto $dto): AuthorDto;

    /**
     * Найти автора по полному соответствию имени
     *
     * @param string $name
     *
     * @return AuthorDto
     */
    public function findByFullName(string $name): AuthorDto;

    /**
     * Найти автора по идентификатору
     *
     * @param int $authorId
     *
     * @return \app\services\author\dtos\AuthorDto
     */
    public function findById(int $authorId): AuthorDto;


    /**
     * Справочник авторов:
     * - *ключ* - ID
     * - *значение* - ФИО
     *
     * @return array
     */
    public function getDirectory(): array;
}