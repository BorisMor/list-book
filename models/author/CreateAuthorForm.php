<?php

declare(strict_types=1);

namespace app\models\author;

use Yii;
use yii\base\Model;

/**
 * Модель формы для создания автора
 */
class CreateAuthorForm extends Model
{
    public const ATTR_TITLE = 'title';

    public $title;

    public function rules()
    {
        return [
            [[self::ATTR_TITLE], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            self::ATTR_TITLE => Yii::t('app', 'Ф.И.О.'),
        ];
    }
}