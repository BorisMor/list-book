<?php

declare(strict_types=1);

namespace app\services\report;

use app\services\report\dtos\SettingsTopAuthorDto;
use app\services\report\repository\ReportRepositoryInterface;

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
    public function topAuthor(SettingsTopAuthorDto $settings): array
    {
        return $this->repository->topAuthor($settings);
    }
}