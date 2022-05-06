<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\author\CreateAuthorForm;
use app\models\subscription\SubscriptionEmailForm;
use app\services\author\AuthorServiceInterface;
use app\services\author\exceptions\CreateAuthorException;
use app\services\author\factory\CreateAuthorDtoFactory;
use app\services\subscription\SubscriptionServiceInterface;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AuthorController extends Controller
{
    /**
     * @var \app\services\author\AuthorServiceInterface
     */
    private AuthorServiceInterface $authorService;
    /**
     * @var \app\services\subscription\SubscriptionServiceInterface
     */
    private SubscriptionServiceInterface $subscriptionService;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['crate', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function __construct($id, $module, AuthorServiceInterface $authorService, SubscriptionServiceInterface $subscriptionService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authorService       = $authorService;
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Список авторов
     */
    public function actionIndex()
    {
        $dp = $this->authorService->getDataProvider();

        return $this->render('index', [
            'dp' => $dp,
        ]);
    }

    /**
     * Создание автора
     */
    public function actionCreate()
    {
        $model = new CreateAuthorForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $createDto = CreateAuthorDtoFactory::craeteFromForm($model);

            try {
                $this->authorService->create($createDto);
                Yii::$app->session->addFlash('success', Yii::t('app', 'Автор создан: {name}', ['name' => $createDto->getTitle()]));

            } catch (CreateAuthorException $e) {
                $model->addErrors($e->getErrors());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $authorDto = $this->authorService->findById((int) $id);
        $model     = new SubscriptionEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $this->subscriptionService->onAuthorByEmail($authorDto->getId(), $model->email);
                Yii::$app->session->addFlash('success', Yii::t('app', 'Подписка на {name} выполнена', ['name' => $authorDto->getTitle()]));
            } catch (\Exception $e) {
                Yii::$app->session->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('view', [
            'authorDto' => $authorDto,
            'model'     => $model,
        ]);
    }
}