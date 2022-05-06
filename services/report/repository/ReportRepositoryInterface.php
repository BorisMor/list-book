<?php

declare(strict_types=1);

namespace app\services\report\repository;

use app\services\report\dtos\ItemTopAuthorDto;
use app\services\report\dtos\SettingsTopAuthorDto;

interface ReportRepositoryInterface
{
    /**
     * ТОП авторы
     *
     * @param SettingsTopAuthorDto $settings
     *
     * @return ItemTopAuthorDto[]
     */
    public function topAuthor(SettingsTopAuthorDto $settings): array;
}