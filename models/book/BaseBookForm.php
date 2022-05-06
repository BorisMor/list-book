<?php

declare(strict_types=1);

namespace app\models\book;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Модель формы для создания\редактирование книги
 */
abstract class BaseBookForm extends Model
{
    public const ATTR_TITLE        = 'title';
    public const ATTR_PUBLISH_YEAR = 'publishYear';
    public const ATTR_DESCRIPTION  = 'description';
    public const ATTR_ISBN         = 'isbn';
    public const ATTR_COVER        = 'cover';
    public const ATTR_AUTHORS      = 'authors';

    public $title;
    public $publishYear;
    public $description;
    public $isbn;
    public $cover;
    public $authors;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [[self::ATTR_TITLE, self::ATTR_AUTHORS, self::ATTR_ISBN], 'required'],
            [[self::ATTR_TITLE, self::ATTR_DESCRIPTION], 'string'],
            [[self::ATTR_PUBLISH_YEAR], 'integer'],
            [[self::ATTR_ISBN], 'string', 'max' => 20],
            [[self::ATTR_COVER], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_TITLE        => Yii::t('app', 'Название'),
            self::ATTR_PUBLISH_YEAR => Yii::t('app', 'Год публикации'),
            self::ATTR_DESCRIPTION  => Yii::t('app', 'Описание'),
            self::ATTR_ISBN         => Yii::t('app', 'Код ISBN'),
            self::ATTR_COVER        => Yii::t('app', 'Обложка'),
            self::ATTR_AUTHORS      => Yii::t('app', 'Авторы'),
        ];
    }

    public function load($data, $formName = null)
    {
        $result      = parent::load($data, $formName);
        $this->cover = UploadedFile::getInstance($this, self::ATTR_COVER);

        return $result;
    }
}