<?php

declare(strict_types=1);

namespace common\components\data;

use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;

/**
 * Расширение {@see ActiveDataProvider} для получения моделей в виде DTO
 */
class ActiveDataDTOProvider extends ActiveDataProvider
{
    public ?ActiveDataDTOFactoryInterface $converter = null;

    private $dtos;

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    protected function prepareModels()
    {
        if ($this->converter === null) {
            throw new InvalidConfigException(Yii::t('app', 'Не задан конвертер.'));
        }

        $activeRecords = parent::prepareModels();

        $this->dtos = $this->converter::createFromActiveRecords($activeRecords);

        return $activeRecords;
    }

    /**
     * @inheritDoc
     */
    public function prepare($forcePrepare = false)
    {
        $isNullableModels = $this->dtos === null;

        parent::prepare($forcePrepare);

        if ($forcePrepare || $isNullableModels) {
            $this->setModels($this->dtos);
        }
    }
}