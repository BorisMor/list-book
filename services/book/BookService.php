<?php

declare(strict_types=1);

namespace app\services\book;

use app\services\book\dtos\BookDto;
use app\services\book\dtos\ModifiedBookDto;
use app\services\book\exceptions\CreateBookException;
use app\services\book\exceptions\UpdateBookException;
use app\services\book\factory\BookDtoFactory;
use app\services\book\repository\BookCoverRepositoryInterface;
use app\services\book\repository\BookRepositoryInterface;
use Exception;
use Yii;
use yii\data\DataProviderInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var \app\services\book\repository\BookRepositoryInterface
     */
    private BookRepositoryInterface $repository;
    /**
     * @var \app\services\book\repository\BookCoverRepositoryInterface
     */
    private BookCoverRepositoryInterface $coverRepository;

    public function __construct(BookRepositoryInterface $repository, BookCoverRepositoryInterface $coverRepository)
    {
        $this->repository      = $repository;
        $this->coverRepository = $coverRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(ModifiedBookDto $createDto): BookDto
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $newDto = $this->repository->create($createDto);
            $this->repository->setAuthors($newDto, $createDto->getAuthorIds());

            // Загрузка изображения
            if ($fileName = $this->coverRepository->saveFileUpload($newDto, $createDto->getCover())) {
                $this->repository->setCover($newDto, $fileName);
            }

            $resultDto = $this->repository->findById($newDto->getId());
            $transaction->commit();

        } catch (CreateBookException $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new CreateBookException([], $e->getMessage());
        }

        return $resultDto;
    }

    /**
     * @inheritDoc
     */
    public function update(BookDto $currentDto, ModifiedBookDto $updateDto): BookDto
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $newDto = $this->repository->update($currentDto, $updateDto);
            $this->repository->setAuthors($newDto, $updateDto->getAuthorIds());

            // Загрузка изображения
            if ($fileName = $this->coverRepository->saveFileUpload($newDto, $updateDto->getCover())) {
                $this->repository->setCover($newDto, $fileName);
            }

            $resultDto = $this->repository->findById($newDto->getId());
            $transaction->commit();

        } catch (UpdateBookException $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new UpdateBookException([], $e->getMessage());
        }

        return $resultDto;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $bookId): BookDto
    {
        return $this->repository->findById($bookId);
    }

    /**
     * @inheritDoc
     */
    public function getDataProvider(int $page = 0, int $pageSize = 50): DataProviderInterface
    {
        $converter = new BookDtoFactory();

        return $this->repository->getDataProvider($page, $pageSize, $converter);
    }
}