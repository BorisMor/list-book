<?php

declare(strict_types=1);

use app\models\author\CreateAuthorForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/**
 * @var CreateAuthorForm $model
 */
?>

<h1><?= Yii::t('app', 'Создать автора') ?></h1>

<div class="content-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, CreateAuthorForm::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>