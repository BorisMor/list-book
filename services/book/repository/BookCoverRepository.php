<?php

declare(strict_types=1);

namespace app\services\book\repository;

use app\services\book\dtos\BookDto;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class BookCoverRepository implements BookCoverRepositoryInterface
{
    protected const DIR_UPLOAD = 'uploads';

    /**
     * Вернет каталог с загрузки
     *
     * @return string
     * @throws \yii\base\Exception
     */
    protected static function getPathUpload(): string
    {
        static $result;

        if ($result) {
            return $result;
        }

        $result = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::DIR_UPLOAD;

        if (!is_dir($result)) {
            FileHelper::createDirectory($result);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function saveFileUpload(BookDto $book, ?UploadedFile $uploaded): ?string
    {
        if (!$uploaded) {
            return null;
        }

        $fileName = $book->getId() . '_' . $uploaded->name;
        $uploaded->saveAs(static::getPathUpload() . DIRECTORY_SEPARATOR . $fileName);

        return $fileName;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(?string $fileName): string
    {
        return $fileName ? '/' . self::DIR_UPLOAD . '/' . $fileName : '';
    }
}