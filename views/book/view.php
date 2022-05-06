<?php

declare(strict_types=1);

use app\services\book\dtos\BookDto;
use yii\widgets\DetailView;
use yii\base\Model;

/**
 * @var BookDto $currentDto
 */

$model = new Model(); // заглушка

?>

<?= Yii::t('app', 'Книга № {id}', ['id' => $currentDto->getId()]) ?>

<div class="row">
    <div class="col-sm-6">
        <?= DetailView::widget([
            'model'      => $model,
            'attributes' => [
                [
                    'label' => Yii::t('app', 'ID'),
                    'value' => $currentDto->getId(),
                ],
                [
                    'label' => Yii::t('app', 'Название книги'),
                    'value' => $currentDto->getTitle(),
                ],
                [
                    'label' => Yii::t('app', 'Год издания'),
                    'value' => $currentDto->getPublishYear(),
                ],
                [
                    'label' => Yii::t('app', 'ISBN'),
                    'value' => $currentDto->getIsbn(),
                ],
            ],
        ]); ?>
    </div>
</div>