<?php

declare(strict_types=1);

namespace app\controllers;

use app\services\author\AuthorServiceInterface;
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
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function __construct($id, $module, AuthorServiceInterface $authorService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authorService = $authorService;
    }

    public function actionIndex()
    {
        $dp = $this->authorService->getDataProvider();
        return $this->render('index', [
            'dp' => $dp
        ]);
    }
}