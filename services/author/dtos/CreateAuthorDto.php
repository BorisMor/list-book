<?php

declare(strict_types=1);

namespace app\services\author\dtos;

/**
 * DTO для создание автора
 */
class CreateAuthorDto
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * ФИО
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}