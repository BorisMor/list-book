<?php

use app\common\components\Migration;

/**
 * Class m220505_051130_book_author
 */
class m220505_051130_book_author extends Migration
{
    private const TABLE_BOOK_AUTHOR = '{{%book_author}}';
    private const TABLE_BOOK        = '{{%books}}';
    private const TABLE_AUTHOR      = '{{%authors}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(self::TABLE_BOOK_AUTHOR, [
            'book_id'    => $this->integer()->notNull()->comment('Идентификатор книги'),
            'author_id'  => $this->integer()->notNull()->comment('Идентификатор автора'),
            'created_at' => $this->createdAt(),
        ]);

        $this->addCommentOnTable(self::TABLE_BOOK_AUTHOR, 'Связка книги и автора');

        $this->addForeignKey('fk_book_author_book_id',
            self::TABLE_BOOK_AUTHOR, 'book_id',
            self::TABLE_BOOK, 'id',
            'CASCADE', 'CASCADE'
        );

        $this->addForeignKey('fk_book_author_author_id',
            self::TABLE_BOOK_AUTHOR, 'author_id',
            self::TABLE_AUTHOR, 'id',
            'CASCADE', 'CASCADE'
        );

        $this->createIndex('inx_book_author_book_id_author_id', self::TABLE_BOOK_AUTHOR, ['book_id', 'author_id'], true);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(self::TABLE_BOOK_AUTHOR);

        return true;
    }
}
