<?php

namespace app\services\author\ars;

use app\common\traits\TimestampBehaviorTrait;
use app\services\book\ars\Book;
use app\services\book\ars\BookAuthor;
use app\services\subscription\ars\SubscriptionAuthor;
use app\services\subscription\ars\SubscriptionNotification;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "authors".
 *
 * @property int                        $id         Идентификатор
 * @property string                     $title      ФИО
 * @property string                     $created_at Дата создания
 * @property string                     $updated_at Дата изменения
 *
 * @property BookAuthor[]               $bookAuthors
 * @property Book[]                     $books
 * @property SubscriptionNotification[] $notifications
 * @property SubscriptionAuthor[]       $subscriptionAuthors
 */
class Author extends ActiveRecord
{
    use TimestampBehaviorTrait;

    /** @var string Идентификатор */
    public const ATTR_ID = 'id';
    /** @var string ФИО */
    public const ATTR_TITLE = 'title';
    /** @var string  Дата создания */
    public const ATTR_CREATED_AT = 'created_at';
    /** @var string  Дата изменения */
    public const ATTR_UPDATED_AT = 'updated_at';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%authors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[self::ATTR_TITLE], 'required'],
            [[self::ATTR_CREATED_AT, self::ATTR_UPDATED_AT], 'safe'],
            [[self::ATTR_TITLE], 'string', 'max' => 255],
            [[self::ATTR_TITLE], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_ID         => Yii::t('app', 'Идентификатор'),
            self::ATTR_TITLE      => Yii::t('app', 'ФИО'),
            self::ATTR_CREATED_AT => Yii::t('app', 'Дата создания'),
            self::ATTR_UPDATED_AT => Yii::t('app', 'Дата изменения'),
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, [BookAuthor::ATTR_AUTHOR_ID => self::ATTR_ID]);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, [Book::ATTR_ID => BookAuthor::ATTR_BOOK_ID])
            ->viaTable(BookAuthor::tableName(), [BookAuthor::ATTR_AUTHOR_ID => self::ATTR_ID]);
    }

    /**
     * Gets query for [[Notification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(SubscriptionNotification::class, [SubscriptionNotification::ATTR_ID => SubscriptionAuthor::ATTR_NOTIFICATION_ID])
            ->viaTable(SubscriptionAuthor::tableName(), [SubscriptionAuthor::ATTR_AUTHOR_ID => self::ATTR_ID]);
    }

    /**
     * Gets query for [[SubscriptionAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionAuthors()
    {
        return $this->hasMany(SubscriptionAuthor::class, ['author_id' => self::ATTR_ID]);
    }
}
