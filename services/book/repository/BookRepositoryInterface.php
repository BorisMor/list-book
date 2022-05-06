<?php

declare(strict_types=1);

namespace app\services\book\repository;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\services\book\dtos\BookDto;
use app\services\book\dtos\ModifiedBookDto;
use yii\data\DataProviderInterface;

/**
 * Отвечает за хранение данных по книге
 */
interface BookRepositoryInterface
{
    /**
     * Создать запись о книге
     *
     * @param ModifiedBookDto $createDto
     *
     * @return BookDto
     */
    public function create(ModifiedBookDto $createDto): BookDto;

    /**
     * Обновить книгу
     *
     * @param BookDto         $currentBookDto
     * @param ModifiedBookDto $updateDto Данные для изменения
     *
     * @return \app\services\book\dtos\BookDto
     */
    public function update(BookDto $currentBookDto, ModifiedBookDto $updateDto): BookDto;

    /**
     * Указать имя файла обложки
     *
     * @param BookDto $dto
     * @param string  $fileName
     */
    public function setCover(BookDto $dto, string $fileName): void;

    /**
     * Обновить автора
     *
     * @param BookDto $dto
     * @param int[]   $authorsIds ID авторов
     */
    public function setAuthors(BookDto $dto, array $authorsIds): void;

    /**
     * Найти книгу по идентификатору
     *
     * @param int $bookId
     *
     * @return BookDto
     */
    public function findById(int $bookId): BookDto;

    /**
     * Провайдер данных по книгам
     *
     * @param int                           $page     Страница
     * @param int                           $pageSize Размер страницы
     * @param ActiveDataDTOFactoryInterface $factory  Фабрика в DTO
     *
     * @return DataProviderInterface
     */
    public function getDataProvider(int $page, int $pageSize, ActiveDataDTOFactoryInterface $factory): DataProviderInterface;
}