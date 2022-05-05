<?php

declare(strict_types=1);

namespace app\common\traits;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Трейт для Active Record добавляющий поведение TimestampBehavior.<br><br>
 *
 * Подходит для моделей, которые имеют атрибуты на создание (created_at) и обновление (updated_at) и не содержат другие поведения.
 */
trait TimestampBehaviorTrait
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => self::ATTR_CREATED_AT,
                'updatedAtAttribute' => self::ATTR_UPDATED_AT,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}