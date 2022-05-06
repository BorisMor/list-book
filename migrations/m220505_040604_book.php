<?php

use app\common\components\Migration;

/**
 * Class m220505_040604_book
 */
class m220505_040604_book extends Migration
{
    private const TABLE_BOOK = '{{%books}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(self::TABLE_BOOK, [
            'id'           => $this->primaryKey()->comment('Идентификатор'),
            'title'        => $this->text()->notNull()->comment('Название'),
            'publish_year' => $this->integer()->notNull()->comment('Год выпуска'),
            'description'  => $this->text()->comment('Описание'),
            'isbn'         => $this->string(20)->notNull()->unique()->comment('ISBN'),
            'cover_image'  => $this->string(260)->comment('Изображение обложки'),
            'created_at'   => $this->createdAt(),
            'updated_at'   => $this->updatedAt(),
        ]);
        $this->addCommentOnTable(self::TABLE_BOOK, 'Список книг');

        $this->createIndex('inx_books_publish_year', self::TABLE_BOOK, 'publish_year');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(self::TABLE_BOOK);

        return true;
    }
}
