<?php

declare(strict_types=1);


namespace app\services\report;

use app\services\report\dtos\SettingsTopAuthorDto;
use app\services\report\dtos\ItemTopAuthorDto;

/**
 * Отвечает за отчеты
 */
interface ReportServiceInterface
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