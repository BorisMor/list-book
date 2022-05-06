<?php

declare(strict_types=1);

use app\models\subscription\SubscriptionEmailForm;
use app\services\author\dtos\AuthorDto;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var AuthorDto             $authorDto
 * @var SubscriptionEmailForm $model
 */

?>

    <h2><?= Yii::t('app', 'Подписка на  {name}', ['name' => $authorDto->getTitle()]) ?></h2>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, SubscriptionEmailForm::ATTR_EMAIL) ?>

<?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton('Подписаться', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>