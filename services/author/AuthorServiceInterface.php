<?php

declare(strict_types=1);

namespace app\services\author;

use app\services\author\dtos\AuthorDto;
use app\services\author\dtos\CreateAuthorDto;
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

    /**
     * Создать запись об авторе
     *
     * @param CreateAuthorDto $dto
     *
     * @return AuthorDto
     */
    public function create(CreateAuthorDto $dto): AuthorDto;

    /**
     * Справочник авторов:
     * - *ключ* - ID
     * - *значение* - ФИО
     *
     * @return array
     */
    public function getDirectory(): array;

    /**
     * Найти автора по идентификатору
     *
     * @param int $authorId
     *
     * @return \app\services\author\dtos\AuthorDto
     */
    public function findById(int $authorId): AuthorDto;
}