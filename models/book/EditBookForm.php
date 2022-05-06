<?php

declare(strict_types=1);

namespace app\models\book;

use app\services\author\dtos\AuthorDto;
use app\services\book\dtos\BookDto;

/**
 * Модель формы для редактирования книги
 */
class EditBookForm extends BaseBookForm
{
    public $coverUrl;
    public $id;

    /**
     * Загружаем данные из готовой книги
     *
     * @param BookDto $dto
     */

    /**
     * Загружаем текущие значения из готовой книги
     *
     * @param BookDto $dto
     *
     * @return $this
     */
    public function loadDto(BookDto $dto): self
    {
        $this->id          = $dto->getId();
        $this->title       = $dto->getTitle();
        $this->description = $dto->getDescription();
        $this->isbn        = $dto->getIsbn();
        $this->publishYear = $dto->getPublishYear();
        $this->authors     = array_map(fn(AuthorDto $author) => $author->getId(), $dto->getAuthors());
        $this->coverUrl    = $dto->getCover();

        return $this;
    }
}