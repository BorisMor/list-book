<?php

declare(strict_types=1);

namespace app\services\report\repository;

use app\services\report\dtos\ItemTopAuthorDto;
use app\services\report\dtos\SettingsTopAuthorDto;

class ReportRepository implements ReportRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function topAuthor(SettingsTopAuthorDto $settings): array
    {
        return []; // todo доделать
    }
}