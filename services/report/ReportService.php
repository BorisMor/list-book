<?php

declare(strict_types=1);

namespace app\services\report;

use app\services\report\dtos\SettingsTopAuthorDto;
use app\services\report\repository\ReportRepositoryInterface;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;

class ReportService implements ReportServiceInterface
{
    /**
     * @var \app\services\report\repository\ReportRepositoryInterface
     */
    private ReportRepositoryInterface $repository;

    public function __construct(ReportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function topAuthor(SettingsTopAuthorDto $settings): DataProviderInterface
    {
        return new ArrayDataProvider([
            'allModels'  => $this->repository->topAuthor($settings),
            'pagination' => [
                'pageSize' => $settings->getCount(),
            ],
        ]);
    }
}