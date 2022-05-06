<?php

declare(strict_types=1);

use app\services\author\dtos\AuthorDto;
use yii\data\DataProviderInterface;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var DataProviderInterface $dp
 */

$isLogin = !Yii::$app->user->isGuest;

?>

    <h1><?= Yii::t('app', 'Авторы') ?></h1>

<?php if ($isLogin): ?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a(Yii::t('app', 'Добавить автора'), Url::toRoute(['author/create']), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
    <br>
<?php endif ?>

<?= GridView::widget([
    'dataProvider' => $dp,
    'columns'      => [
        [
            'attribute' => 'id',
            'value'     => fn(AuthorDto $dto) => $dto->getId(),
        ],
        [
            'attribute' => 'title',
            'value'     => fn(AuthorDto $dto) => $dto->getTitle(),
        ],
        [
            'class'          => ActionColumn::class,
            'header'         => Yii::t('app', 'Действия'),
            'headerOptions'  => ['width' => '80'],
            'template'       => '{view}',
            'visibleButtons' => [
                'view' => true,
                'edit' => $isLogin,
            ],
        ],

    ],
]) ?>