<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\book\BaseBookForm;
use app\models\book\CreateBookForm;
use app\models\book\EditBookForm;
use app\services\author\AuthorServiceInterface;
use app\services\book\BookServiceInterface;
use app\services\book\exceptions\CreateBookException;
use app\services\book\factory\ModifiedBookDtoFactory;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class BookController extends Controller
{
    /**
     * @var \app\services\book\BookServiceInterface
     */
    private BookServiceInterface $service;
    /**
     * @var \app\services\author\AuthorServiceInterface
     */
    private AuthorServiceInterface $authorService;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['crate', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function __construct($id, $module, BookServiceInterface $service, AuthorServiceInterface $authorService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service       = $service;
        $this->authorService = $authorService;
    }

    public function actionIndex()
    {
        $dp = $this->service->getDataProvider();

        return $this->render('index', [
            'dp' => $dp,
        ]);
    }

    public function actionCreate()
    {
        $model = new CreateBookForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $createDto = ModifiedBookDtoFactory::createFromForm($model);
                $bookDto = $this->service->create($createDto);
                Yii::$app->session->addFlash('success', Yii::t('app', 'Книга создана: {name}', ['name' => $createDto->getTitle()]));

                $this->redirect(['book/update', 'id' => $bookDto->getId()]);

            } catch (CreateBookException $e) {
                $model->addErrors($e->getErrors());
            }
        }

        return $this->render('create', [
            'model'   => $model,
            'authors' => $this->authorService->getDirectory(),
        ]);
    }

    public function actionUpdate($id)
    {
        $currentDto   = $this->service->findById((int) $id);
        $model = (new EditBookForm())->loadDto($currentDto);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            try {
                $updateDto = ModifiedBookDtoFactory::createFromForm($model);
                $this->service->update($currentDto, $updateDto);
                Yii::$app->session->addFlash('success', Yii::t('app', 'Книга обновлена: {name}', ['name' => $updateDto->getTitle()]));
            } catch (CreateBookException $e) {
                $model->addErrors($e->getErrors());
            }
        }

        return $this->render('edit', [
            'model'   => $model,
            'authors' => $this->authorService->getDirectory(),
        ]);
    }

    public function actionView($id)
    {
        $currentDto   = $this->service->findById((int) $id);
        return $this->render('view', [
            'currentDto'   => $currentDto,
        ]);
    }
}