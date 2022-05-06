<?php

declare(strict_types=1);

namespace app\models\subscription;

use Yii;
use yii\base\Model;

class SubscriptionEmailForm extends Model
{
    public $email;

    public const ATTR_EMAIL = 'email';

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [[self::ATTR_EMAIL,], 'required'],
            [[self::ATTR_EMAIL], 'email'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            self::ATTR_EMAIL => Yii::t('app', 'Почта для подписки'),
        ];
    }
}