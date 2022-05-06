<?php

use app\models\reports\ReportTopAuthorForm;
use app\services\report\dtos\ItemTopAuthorDto;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\data\DataProviderInterface;
use yii\grid\GridView;

/**
 * @var ReportTopAuthorForm $model
 * @var ItemTopAuthorDto[] $items
 * @var DataProviderInterface|null $dp
 */
?>

<h1><?= Yii::t('app', 'Отчет') ?></h1>

<div class="content-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, ReportTopAuthorForm::ATTR_YEAR) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, ReportTopAuthorForm::ATTR_COUNT) ?>
        </div>
    </div>

    <?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton('Показать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php if ($dp): ?>
<?= GridView::widget([
         'dataProvider' => $dp,
         'columns'      => [
             [
                 'attribute' => 'id',
                 'value'     => fn(ItemTopAuthorDto $dto) => $dto->getAuthorId(),
             ],
             [
                 'attribute' => 'title',
                 'value'     => fn(ItemTopAuthorDto $dto) => $dto->getTitle(),
             ],
             [
                 'attribute' => 'count_book',
                 'value'     => fn(ItemTopAuthorDto $dto) => $dto->getCountBook(),
             ],
         ]
    ]);
?>
<?php endif; ?>
