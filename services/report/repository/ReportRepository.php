<?php

declare(strict_types=1);

namespace app\services\report\repository;

use app\services\book\ars\Book;
use app\services\report\dtos\SettingsTopAuthorDto;
use app\services\report\factory\ItemTopAuthorDtoFactory;
use yii\db\Query;

class ReportRepository implements ReportRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function topAuthor(SettingsTopAuthorDto $settings): array
    {
        $items = [];

        /**
         *
         * SELECT a.id, a.title, count(*)
         * FROM books b
         * LEFT JOIN book_author ba on ba.book_id = b.id
         * LEFT JOIN authors a on a.id = ba.author_id
         * WHERE b.publish_year = 2020
         * GROUP BY a.id
         * ORDER BY count(*) desc
         *
         */

        $query = (new Query())
            ->select(['id' => 'a.id', 'title' => 'a.title', 'count_book' => 'count(*)'])
            ->from(['b' => Book::tableName()])
            ->leftJoin(['ba' => 'book_author'], 'ba.book_id = b.id')
            ->leftJoin(['a' => 'authors'], 'a.id = ba.author_id')
            ->groupBy('a.id')
            ->orderBy('count(*) desc');

        $query->andWhere(['b.publish_year' => $settings->getYear()]);
        $query->limit($settings->getCount());

        foreach ($query->all() as $row) {
            $items[] = ItemTopAuthorDtoFactory::create(
                $row['title'],
                (int)$row['id'],
                (int)$row['count_book']
            );
        }

        return $items;
    }
}