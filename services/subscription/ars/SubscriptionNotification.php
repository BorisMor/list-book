<?php

namespace app\services\subscription\ars;

use app\common\traits\TimestampBehaviorTrait;
use app\services\author\ars\Author;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscription_notifications".
 *
 * @property int                  $id         Идентификатор
 * @property string               $email      Почта
 * @property string               $created_at Дата создания
 * @property string               $updated_at Дата изменения
 *
 * @property Author[]             $authors
 * @property SubscriptionAuthor[] $subscriptionAuthors
 */
class SubscriptionNotification extends ActiveRecord
{
    use TimestampBehaviorTrait;

    public const ATTR_ID         = 'id';
    public const ATTR_EMAIL      = 'email';
    public const ATTR_CREATED_AT = 'created_at';
    public const ATTR_UPDATED_AT = 'updated_at';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription_notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[self::ATTR_EMAIL], 'required'],
            [[self::ATTR_CREATED_AT, self::ATTR_UPDATED_AT], 'safe'],
            [[self::ATTR_EMAIL], 'string', 'max' => 320],
            [[self::ATTR_EMAIL], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_ID         => Yii::t('app', 'Идентификатор'),
            self::ATTR_EMAIL      => Yii::t('app', 'Почта'),
            self::ATTR_CREATED_AT => Yii::t('app', 'Дата создания'),
            self::ATTR_UPDATED_AT => Yii::t('app', 'Дата изменения'),
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, [Author::ATTR_ID => SubscriptionAuthor::ATTR_AUTHOR_ID])
            ->viaTable(SubscriptionAuthor::tableName(), [SubscriptionAuthor::ATTR_NOTIFICATION_ID => self::ATTR_ID]);
    }

    /**
     * Gets query for [[SubscriptionAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionAuthors()
    {
        return $this->hasMany(SubscriptionAuthor::class, [SubscriptionAuthor::ATTR_NOTIFICATION_ID => self::ATTR_ID]);
    }
}
