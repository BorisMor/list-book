<?php

declare(strict_types=1);

namespace app\services\book\factory;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\services\author\factory\AuthorDtoFactory;
use app\services\book\ars\Book;
use app\services\book\dtos\BookDto;
use app\services\book\repository\BookCoverRepositoryInterface;
use Yii;

/**
 * Фабрика для {@see BookDto}
 */
class BookDtoFactory implements ActiveDataDTOFactoryInterface
{
    public static function create(int $id, string $title, int $publishYear, string $description, string $isbn, string $cover, array $authors): BookDto
    {
        return new BookDto($id, $title, $publishYear, $description, $isbn, $cover, $authors);
    }

    /**
     * На основе ActiveRecord {@see Book}
     *
     * @param Book   $ar
     * @param string $coverUrl Ссылка на обложку
     *
     * @return BookDto
     */
    public static function createFromActiveRecord(Book $ar, string $coverUrl): BookDto
    {
        $authors = [];
        foreach ($ar->authors as $authorAr) {
            $authors[] = AuthorDtoFactory::createFromActiveRecord($authorAr);
        }

        return static::create($ar->id, $ar->title, $ar->publish_year, (string) $ar->description, $ar->isbn, $coverUrl, $authors);
    }

    /**
     * @inheritDoc
     */
    public static function createFromActiveRecords(array $activeRecordModels): array
    {
        $dtos = [];
        /** @var BookCoverRepositoryInterface $bookCover */
        $bookCover = Yii::$container->get(BookCoverRepositoryInterface::class);

        /** @var Book $ar */
        foreach ($activeRecordModels as $ar) {
            $dto = self::createFromActiveRecord($ar, $bookCover->getUrl($ar->cover_image));

            if ($dto) {
                $dtos[] = $dto;
            }
        }

        return $dtos;
    }
}