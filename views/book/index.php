<?php

declare(strict_types=1);

use app\services\book\dtos\BookDto;
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

    <h1><?= Yii::t('app', 'Книги') ?></h1>

<?php if ($isLogin): ?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a(Yii::t('app', 'Добавить книгу'), Url::toRoute(['book/create']), ['class' => 'btn btn-primary']); ?>
        </div>
    </div>
    <br>
<?php endif; ?>

<?= GridView::widget([
    'dataProvider' => $dp,
    'columns'      => [
        [
            'attribute' => 'id',
            'value'     => fn(BookDto $dto) => $dto->getId(),
        ],
        [
            'attribute' => 'title',
            'value'     => fn(BookDto $dto) => $dto->getTitle(),
        ],
        [
            'attribute' => 'publish_year',
            'value'     => fn(BookDto $dto) => $dto->getPublishYear(),
        ],
        [
            'attribute' => 'isbn',
            'value'     => fn(BookDto $dto) => $dto->getIsbn(),
        ],
        [
            'attribute' => 'author',
            'header' => Yii::t('app', 'Автор'),
            'value'     => fn(BookDto $dto) => $dto->getIsbn(),
        ],
        [
            'class'          => ActionColumn::class,
            'header'         => Yii::t('app', 'Действия'),
            'headerOptions'  => ['width' => '80'],
            'template'       => '{view} {update}',
            'visibleButtons' => [
                'view' => true,
                'edit' => $isLogin,
            ],
        ],
    ],
]) ?>