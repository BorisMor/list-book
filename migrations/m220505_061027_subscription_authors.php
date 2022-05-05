<?php

use app\common\components\Migration;

/**
 * Class m220505_061027_subscription_autors
 */
class m220505_061027_subscription_authors extends Migration
{
    public const  TABLE_SUBSCRIPTION_AUTHORS      = '{{%subscription_authors}}';
    private const TABLE_AUTHOR                    = '{{%authors}}';
    private const TABLE_SUBSCRIPTION_NOTIFICATION = '{{%subscription_notifications}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(self::TABLE_SUBSCRIPTION_AUTHORS, [
            'author_id'  => $this->integer()->notNull()->comment('Идентификатор автора'),
            'notification_id'   => $this->integer()->notNull()->comment('Идентификатор оповещения'),
            'created_at' => $this->createdAt(),
        ]);

        $this->addForeignKey('fk_subscription_authors_author_id',
            self::TABLE_SUBSCRIPTION_AUTHORS, 'author_id',
            self::TABLE_AUTHOR, 'id',
            'CASCADE', 'CASCADE'
        );

        $this->addForeignKey('fk_subscription_authors_notification_id',
            self::TABLE_SUBSCRIPTION_AUTHORS, 'notification_id',
            self::TABLE_SUBSCRIPTION_NOTIFICATION, 'id',
            'CASCADE', 'CASCADE'
        );

        $this->createIndex('inx_subscription_authors_author_id_notification_id', self::TABLE_SUBSCRIPTION_AUTHORS, ['author_id', 'notification_id'], true);


        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(self::TABLE_SUBSCRIPTION_AUTHORS);
    }
}
