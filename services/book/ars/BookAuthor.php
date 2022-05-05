<?php

namespace app\services\book\ars;

use app\services\author\ars\Author;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "book_author".
 *
 * @property int    $book_id    Идентификатор книги
 * @property int    $author_id  Идентификатор автора
 * @property string $created_at Дата создания
 *
 * @property Author $author
 * @property Book   $book
 */
class BookAuthor extends ActiveRecord
{
    public const ATTR_BOOK_ID    = 'book_id';
    public const ATTR_AUTHOR_ID  = 'author_id';
    public const ATTR_CREATED_AT = 'created_at';

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => self::ATTR_CREATED_AT,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book_author}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[self::ATTR_BOOK_ID, self::ATTR_AUTHOR_ID], 'required'],
            [[self::ATTR_BOOK_ID, self::ATTR_AUTHOR_ID], 'integer'],
            [[self::ATTR_CREATED_AT], 'safe'],
            [[self::ATTR_BOOK_ID, self::ATTR_AUTHOR_ID], 'unique', 'targetAttribute' => ['book_id', 'author_id']],
            [
                [self::ATTR_AUTHOR_ID],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Author::class,
                'targetAttribute' => [self::ATTR_AUTHOR_ID => Author::ATTR_ID],
            ],
            [
                [self::ATTR_BOOK_ID],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Book::class,
                'targetAttribute' => [self::ATTR_BOOK_ID => Book::ATTR_ID],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id'    => Yii::t('app', 'Идентификатор книги'),
            'author_id'  => Yii::t('app', 'Идентификатор автора'),
            'created_at' => Yii::t('app', 'Дата создания'),
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
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, [Book::ATTR_ID => self::ATTR_BOOK_ID]);
    }
}
