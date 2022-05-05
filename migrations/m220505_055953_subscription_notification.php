<?php

use app\common\components\Migration;

/**
 * Class m220505_055953_subscription_email
 */
class m220505_055953_subscription_notification extends Migration
{
    private const TABLE_SUBSCRIPTION_NOTIFICATION = '{{%subscription_notifications}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(self::TABLE_SUBSCRIPTION_NOTIFICATION, [
            'id'         => $this->primaryKey()->comment('Идентификатор'),
            'email'      => $this->string(320)->notNull()->unique()->comment('Почта'),
            'created_at' => $this->createdAt(),
            'updated_at' => $this->updatedAt(),
        ]);

        $this->addCommentOnTable(self::TABLE_SUBSCRIPTION_NOTIFICATION, 'Данные для оповещения');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(self::TABLE_SUBSCRIPTION_NOTIFICATION);

        return true;
    }
}
