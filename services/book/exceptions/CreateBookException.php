<?php

declare(strict_types=1);

namespace app\services\book\exceptions;

use app\services\book\ars\Book;
use Yii;

/**
 * Ошибка при создание книги
 */
class CreateBookException extends BaseBookException
{
    private array $errors;

    /**
     * @param array  $errors Список ошибок от {@see \yii\db\ActiveRecord}
     * @param string $message Текст ошибки
     */
    public function __construct(array $errors, string $message = "")
    {
        $message = $message ?: Yii::t('app', 'Ошибка при создание книги');

        if (!$errors) {
            $errors = [
                Book::ATTR_ID => [$message]
            ];
        }

        parent::__construct($message);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}