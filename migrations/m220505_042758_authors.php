<?php

use app\common\components\Migration;

/**
 * Class m220505_042758_authors
 */
class m220505_042758_authors extends Migration
{
    private const TABLE_AUTHOR = '{{%authors}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(self::TABLE_AUTHOR, [
            'id'         => $this->primaryKey()->comment('Идентификатор'),
            'title'      => $this->string(255)->notNull()->unique()->comment('ФИО'),
            'created_at'   => $this->createdAt(),
            'updated_at'   => $this->updatedAt(),
        ]);

        $this->addCommentOnTable(self::TABLE_AUTHOR, 'Авторы');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(self::TABLE_AUTHOR);

        return true;
    }
}
