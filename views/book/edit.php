<?php

declare(strict_types=1);

use app\models\book\EditBookForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var EditBookForm $model
 * @var array        $authors
 * @var View         $this
 */
?>

<h1><?= Yii::t('app', 'Редактировать книгу # {id}', ['id' => $model->id]) ?></h1>

<div class="content-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $this->render('_form', [
        'form'    => $form,
        'authors' => $authors,
        'model'   => $model,
    ]) ?>

    <div class="form-group">
    <?= Html::img($model->coverUrl, ['style' => 'max-width: 200px;max-height: 200px;']) ?>
    </div>

    <?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>