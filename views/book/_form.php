<?php

declare(strict_types=1);

use app\models\book\BaseBookForm;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;

/**
 * @var BaseBookForm $model
 * @var array        $authors список авторов
 * @var ActiveForm   $form
 */

?>

<?= $form->field($model, BaseBookForm::ATTR_TITLE) ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, BaseBookForm::ATTR_PUBLISH_YEAR) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, BaseBookForm::ATTR_ISBN) ?>
    </div>
</div>

<?= $form->field($model, BaseBookForm::ATTR_DESCRIPTION)->textarea() ?>
<?= $form->field($model, BaseBookForm::ATTR_AUTHORS)->widget(Select2::class, [
    'data'          => $authors,
    'language'      => 'de',
    'options'       => [
        'multiple'    => true,
        'placeholder' => 'Выберите авторов ...',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]); ?>
<?= $form->field($model, BaseBookForm::ATTR_COVER)->fileInput() ?>

