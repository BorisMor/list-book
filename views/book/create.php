<?php

declare(strict_types=1);

use app\models\book\BaseBookForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var BaseBookForm $model
 * @var array        $authors
 * @var View         $this
 */
?>

<h1><?= Yii::t('app', 'Создать книгу') ?></h1>

<div class="content-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $this->render('_form', [
        'form'    => $form,
        'authors' => $authors,
        'model'   => $model,
    ]) ?>

    <?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>