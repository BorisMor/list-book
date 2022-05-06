<?php

declare(strict_types=1);

namespace app\services\report\dtos;

/**
 * Пункт отчета
 */
class ItemTopAuthorDto
{
    private string $title;
    private int    $authorId;
    private int    $countBook;

    public function __construct(string $title, int $authorId, int $countBook)
    {
        $this->title = $title;
        $this->authorId = $authorId;
        $this->countBook = $countBook;
    }

    /**
     * Автор
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Id автора
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * Сколько книг
     *
     * @return int
     */
    public function getCountBook(): int
    {
        return $this->countBook;
    }
}