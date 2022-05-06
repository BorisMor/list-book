<?php

declare(strict_types=1);

namespace app\services\book\repository;

use app\services\book\dtos\BookDto;
use yii\web\UploadedFile;

/**
 * Хранение обложки книги
 */
interface BookCoverRepositoryInterface
{
    /**
     * Сохраняем файл загружаемый для книги.
     * Вернет имя файла
     *
     * @param BookDto           $book
     * @param UploadedFile|null $uploaded
     *
     * @return string|null
     */
    public function saveFileUpload(BookDto $book, ?UploadedFile $uploaded): ?string;

    /**
     * Вернет путь для обращения к файлу
     *
     * @param string|null $fileName
     *
     * @return string
     */
    public function getUrl(?string $fileName): string;
}