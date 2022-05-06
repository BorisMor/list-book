<?php

declare(strict_types=1);

namespace app\services\report\dtos;

/**
 * DTO с настройками отчета
 */
class SettingsTopAuthorDto
{
    private int $count;
    private int $year;

    public function __construct(int $count, int $year)
    {
        $this->count = $count;
        $this->year = $year;
    }

    /**
     * Количество в топе
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * За какой год
     *
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }
}