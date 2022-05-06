<?php

namespace app\services\subscription\ars;

use app\services\author\ars\Author;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "subscription_authors".
 *
 * @property int                      $author_id         Идентификатор автора
 * @property int                      $notification_id   Идентификатор оповещения
 * @property string                   $created_at        Дата создания
 *
 * @property Author                   $author
 * @property SubscriptionNotification $notification
 */
class SubscriptionAuthor extends ActiveRecord
{
    public const ATTR_AUTHOR_ID       = 'author_id';
    public const ATTR_NOTIFICATION_ID = 'notification_id';
    public const ATTR_CREATED_AT      = 'created_at';

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class'              => TimestampBehavior::class,
                'createdAtAttribute' => self::ATTR_CREATED_AT,
                'updatedAtAttribute' => false,
                'value'              => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscription_authors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[self::ATTR_AUTHOR_ID, self::ATTR_NOTIFICATION_ID], 'required'],
            [[self::ATTR_AUTHOR_ID, self::ATTR_NOTIFICATION_ID], 'integer'],
            [[self::ATTR_CREATED_AT], 'safe'],
            [[self::ATTR_AUTHOR_ID, self::ATTR_NOTIFICATION_ID], 'unique', 'targetAttribute' => [self::ATTR_AUTHOR_ID, self::ATTR_NOTIFICATION_ID]],
            [
                [self::ATTR_AUTHOR_ID],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Author::class,
                'targetAttribute' => [self::ATTR_AUTHOR_ID => Author::ATTR_ID],
            ],
            [
                [self::ATTR_NOTIFICATION_ID],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => SubscriptionNotification::class,
                'targetAttribute' => [self::ATTR_NOTIFICATION_ID => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_AUTHOR_ID       => Yii::t('app', 'Идентификатор автора'),
            self::ATTR_NOTIFICATION_ID => Yii::t('app', 'Идентификатор оповещения'),
            self::ATTR_CREATED_AT      => Yii::t('app', 'Дата создания'),
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, [Author::ATTR_ID => self::ATTR_AUTHOR_ID]);
    }

    /**
     * Gets query for [[Email]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmail()
    {
        return $this->hasOne(SubscriptionNotification::class, [SubscriptionNotification::ATTR_ID => self::ATTR_NOTIFICATION_ID]);
    }
}
