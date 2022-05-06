<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\reports\ReportTopAuthorForm;
use app\services\report\ReportServiceInterface;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ReportController extends Controller
{
    /**
     * @var \app\services\report\ReportServiceInterface
     */
    private ReportServiceInterface $reportService;

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

    public function __construct($id, $module, ReportServiceInterface $reportService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->reportService = $reportService;
    }

    public function actionTopAuthor()
    {
        $model = new ReportTopAuthorForm();
        $dp = null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dp = $this->reportService->topAuthor($model->getSettings());
        }

        return $this->render('topAuthor', [
            'model' => $model,
            'dp'    => $dp
        ]);
    }
}