<?php

namespace app\services\book\ars;

use app\common\traits\TimestampBehaviorTrait;
use app\services\author\ars\Author;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int          $id           Идентификатор
 * @property string       $title        Название
 * @property int          $publish_year Год выпуска
 * @property string|null  $description  Описание
 * @property string       $isbn         ISBN
 * @property string|null  $cover_image  Изображение обложки
 * @property string       $created_at   Дата создания
 * @property string       $updated_at   Дата изменения
 *
 * @property Author[]     $authors
 * @property BookAuthor[] $bookAuthors
 */
class Book extends ActiveRecord
{
    use TimestampBehaviorTrait;

    public const ATTR_ID           = 'id';
    public const ATTR_TITLE        = 'title';
    public const ATTR_PUBLISH_YEAR = 'publish_year';
    public const ATTR_DESCRIPTION  = 'description';
    public const ATTR_ISBN         = 'isbn';
    public const ATTR_COVER_IMAGE  = 'cover_image';
    public const ATTR_CREATED_AT   = 'created_at';
    public const ATTR_UPDATED_AT   = 'updated_at';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[self::ATTR_TITLE, self::ATTR_PUBLISH_YEAR, self::ATTR_ISBN], 'required'],
            [[self::ATTR_TITLE, self::ATTR_DESCRIPTION], 'string'],
            [[self::ATTR_PUBLISH_YEAR], 'integer'],
            [[self::ATTR_CREATED_AT, self::ATTR_UPDATED_AT], 'safe'],
            [[self::ATTR_ISBN], 'string', 'max' => 20],
            [[self::ATTR_COVER_IMAGE], 'string', 'max' => 260],
            [[self::ATTR_ISBN], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_ID           => Yii::t('app', 'Идентификатор'),
            self::ATTR_TITLE        => Yii::t('app', 'Название'),
            self::ATTR_PUBLISH_YEAR => Yii::t('app', 'Год выпуска'),
            self::ATTR_DESCRIPTION  => Yii::t('app', 'Описание'),
            self::ATTR_ISBN         => Yii::t('app', 'ISBN'),
            self::ATTR_COVER_IMAGE  => Yii::t('app', 'Изображение обложки'),
            self::ATTR_CREATED_AT   => Yii::t('app', 'Дата создания'),
            self::ATTR_UPDATED_AT   => Yii::t('app', 'Дата изменения'),
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, [Author::ATTR_ID => BookAuthor::ATTR_AUTHOR_ID])
            ->viaTable(BookAuthor::tableName(), [BookAuthor::ATTR_BOOK_ID => self::ATTR_ID]);
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::class, [BookAuthor::ATTR_BOOK_ID => self::ATTR_ID]);
    }
}
