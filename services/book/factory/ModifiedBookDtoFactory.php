<?php

declare(strict_types=1);

namespace app\services\book\factory;

use app\models\book\BaseBookForm;
use app\services\book\dtos\ModifiedBookDto;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Фабрика для {@see ModifiedBookDto}
 */
class ModifiedBookDtoFactory
{
    public static function create(
        string $title,
        int $publishYear,
        string $description,
        string $isbn,
        ?UploadedFile $cover,
        array $authorIds
    ): ModifiedBookDto {
        return new ModifiedBookDto($title, $publishYear, $description, $isbn, $cover, $authorIds);
    }

    /**
     * Создать DTO для создания книги на основе формы
     *
     * @param BaseBookForm $model
     *
     * @return ModifiedBookDto
     */
    public static function createFromForm(BaseBookForm $model): ModifiedBookDto
    {
        return static::create(
            (string) $model->title,
            (int) $model->publishYear,
            (string) $model->description,
            (string) $model->isbn,
            $model->cover,
            $model->authors
        );
    }

}