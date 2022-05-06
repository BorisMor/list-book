<?php

declare(strict_types=1);

namespace app\services\book;

use app\services\book\dtos\BookDto;
use app\services\book\dtos\ModifiedBookDto;

interface BookServiceInterface
{
    /**
     * Создать книжку
     *
     * @param ModifiedBookDto $createDto
     *
     * @return BookDto
     */
    public function create(ModifiedBookDto $createDto): BookDto;

    /**
     * Обновление книги
     *
     * @param BookDto         $currentDto Текущие данные о книге
     * @param ModifiedBookDto $updateDto  Данные для изменения
     *
     * @return BookDto
     */
    public function update(BookDto $currentDto, ModifiedBookDto $updateDto): BookDto;


    /**
     * Поиск книги по идентификатор
     *
     * @param int $bookId
     *
     * @return BookDto
     */
    public function findById(int $bookId): BookDto;
}

