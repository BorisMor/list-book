<?php

declare(strict_types=1);

namespace app\models\reports;

use Yii;
use yii\base\Model;

/**
 * Модель формы для отчета "топ авторы"
 */
class ReportTopAuthorForm extends Model
{
    public const ATTR_YEAR  = 'year';
    public const ATTR_COUNT = 'count';

    public $year;
    public $count;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [[self::ATTR_YEAR, self::ATTR_COUNT], 'required'],
            [[self::ATTR_YEAR, self::ATTR_COUNT], 'integer'],
            [[self::ATTR_COUNT], 'default', 'value' => 10],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_YEAR  => Yii::t('app', 'Год'),
            self::ATTR_COUNT => Yii::t('app', 'Количество'),
        ];
    }
}