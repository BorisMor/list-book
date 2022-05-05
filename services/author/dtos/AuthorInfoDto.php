<?php

declare(strict_types=1);

namespace app\services\author\dtos;

/**
 * DTO с описанием автора
 */
class AuthorInfoDto
{
    private int    $id;
    private string $title;

    public function __construct(int $id, string $title)
    {

        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Идентификатор автора
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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