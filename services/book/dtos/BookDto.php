<?php

declare(strict_types=1);

namespace app\services\book\dtos;

use app\services\author\dtos\AuthorDto;

/**
 * DTO c описанием записи книги
 */
class BookDto
{
    private int    $id;
    private string $title;
    private int    $publishYear;
    private string $description;
    private string $isbn;
    private string $cover;
    private array  $authors;

    public function __construct(int $id, string $title, int $publishYear, string $description, string $isbn, string $cover, array $authors)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->publishYear = $publishYear;
        $this->description = $description;
        $this->isbn        = $isbn;
        $this->cover       = $cover;
        $this->authors     = $authors;
    }

    /**
     * Идентификатор книги
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPublishYear(): int
    {
        return $this->publishYear;
    }

    /**
     * Описание
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Код ISBN
     *
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * Обложка
     *
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * Список авторов
     *
     * @return AuthorDto[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * Указать обложку
     *
     * @param string $cover
     */
    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }
}