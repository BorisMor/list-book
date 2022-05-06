<?php

declare(strict_types=1);

namespace app\services\book\dtos;

use yii\web\UploadedFile;

/**
 * DTO для создания\редактирование книги
 */
class ModifiedBookDto
{
    private string $title;
    private int    $publishYear;
    private string $description;
    private string $isbn;
    /**
     * @var \yii\web\UploadedFile|null
     */
    private ?UploadedFile $cover;
    /** @var int[] ID авторов */
    private array $authorIds;

    /**
     * @param string                     $title       Название книги
     * @param int                        $publishYear Год издания
     * @param string                     $description Описание
     * @param string                     $isbn        ISBN код
     * @param \yii\web\UploadedFile|null $cover       Загружаемая обложка
     * @param int[]                      $authorIds   Список авторов
     */
    public function __construct(string $title, int $publishYear, string $description, string $isbn, ?UploadedFile $cover, array $authorIds)
    {
        $this->title       = $title;
        $this->publishYear = $publishYear;
        $this->description = $description;
        $this->isbn        = $isbn;
        $this->cover       = $cover;
        $this->authorIds   = $authorIds;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return \yii\web\UploadedFile|null
     */
    public function getCover(): ?UploadedFile
    {
        return $this->cover;
    }

    /**
     * @return array
     */
    public function getAuthorIds(): array
    {
        return $this->authorIds;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }
}