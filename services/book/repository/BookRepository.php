<?php

declare(strict_types=1);

namespace app\services\book\repository;

use app\common\components\data\ActiveDataDTOFactoryInterface;
use app\common\components\data\ActiveDataDTOProvider;
use app\services\book\ars\Book;
use app\services\book\ars\BookAuthor;
use app\services\book\dtos\BookDto;
use app\services\book\dtos\ModifiedBookDto;
use app\services\book\exceptions\CreateBookException;
use app\services\book\exceptions\LinkAuthorException;
use app\services\book\exceptions\NotFoundBookException;
use app\services\book\exceptions\UpdateBookException;
use app\services\book\factory\BookDtoFactory;
use yii\data\DataProviderInterface;

class BookRepository implements BookRepositoryInterface
{
    /**
     * @var \app\services\book\repository\BookCoverRepositoryInterface
     */
    private BookCoverRepositoryInterface $coverRepository;

    public function __construct(BookCoverRepositoryInterface $coverRepository)
    {
        $this->coverRepository = $coverRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(ModifiedBookDto $createDto): BookDto
    {
        $ar = new Book();
        $this->fillActiveRecord($ar, $createDto);

        if (!$ar->save()) {
            throw new CreateBookException($ar->getErrors());
        }

        return BookDtoFactory::createFromActiveRecord($ar, '');
    }

    /**
     * @inheritDoc
     */
    public function update(BookDto $currentBookDto, ModifiedBookDto $updateDto): BookDto
    {
        $ar = Book::findOne($currentBookDto->getId());
        if (!$ar) {
            throw new NotFoundBookException('#' . $currentBookDto->getId());
        }

        if (!$ar->save()) {
            throw new UpdateBookException($ar->getErrors());
        }

        return BookDtoFactory::createFromActiveRecord($ar, $currentBookDto->getCover());
    }

    /**
     * Заполнить {@see Book} данные из DTO {@see ModifiedBookDto}
     *
     * @param Book            $ar
     * @param ModifiedBookDto $modifiedDto
     */
    private function fillActiveRecord(Book $ar, ModifiedBookDto $modifiedDto)
    {
        $ar->title        = $modifiedDto->getTitle();
        $ar->isbn         = $modifiedDto->getIsbn();
        $ar->publish_year = $modifiedDto->getPublishYear();
        $ar->description  = $modifiedDto->getDescription();
    }

    /**
     * @inheritDoc
     */
    public function setCover(BookDto $dto, string $fileName): void
    {
        Book::updateAll([Book::ATTR_COVER_IMAGE => $fileName], [
            Book::ATTR_ID => $dto->getId(),
        ]);
    }


    /**
     * @inheritDoc
     */
    public function findById(int $bookId): BookDto
    {
        $ar = Book::findOne($bookId);

        if (!$ar) {
            throw new NotFoundBookException('#' . $bookId);
        }

        $coverUrl = $this->coverRepository->getUrl($ar->cover_image);

        return BookDtoFactory::createFromActiveRecord($ar, $coverUrl);
    }

    /**
     * @inheritDoc
     */
    public function setAuthors(BookDto $dto, array $authorsIds): void
    {
        $currentList = BookAuthor::find()
            ->where([BookAuthor::ATTR_BOOK_ID => $dto->getId()])
            ->indexBy(BookAuthor::ATTR_AUTHOR_ID)
            ->all();

        // добавляем новые связи
        foreach ($authorsIds as $authorId) {
            if (isset($currentList[$authorId])) {
                continue;
            }

            $link            = new BookAuthor();
            $link->author_id = $authorId;
            $link->book_id   = $dto->getId();

            if (!$link->save()) {
                throw new LinkAuthorException($link->getErrors());
            }
        }

        // удаляем старые связи
        foreach ($currentList as $authorId => $ar) {
            if (!in_array($authorId, $authorsIds)) {
                $ar->delete();
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getDataProvider(int $page, int $pageSize, ActiveDataDTOFactoryInterface $factory): DataProviderInterface
    {
        $query = Book::find();

        return new ActiveDataDTOProvider([
            'converter'  => $factory,
            'query'      => $query,
            'pagination' => [
                'pageSize' => $pageSize ?: false,
            ],
        ]);
    }
}