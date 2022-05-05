<?php
declare(strict_types=1);

namespace app\common\components;

use yii\db\Migration as MigrationDb;
use yii\db\ColumnSchemaBuilder;

/**
 * Расширение стандартного {@see Migration}
 */
class Migration extends MigrationDb
{
    /**
     * @inheritDoc
     */
    public function createTable($table, $columns, $options = null)
    {
        if (!$options) {
            $options = $this->getTableOptions();
        }

        parent::createTable($table, $columns, $options);
    }

    /**
     * Получение набора параметров для создаваемых таблиц
     *
     * @param bool $addEngine Добавить ли к параметрам, информацию о движке
     *
     * @return null|string
     */
    public function getTableOptions(bool $addEngine = true): ?string
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci' . ($addEngine ? ' ENGINE=InnoDB' : '');
        }

        return $tableOptions;
    }

    /**
     * Набор параметров для формирования типа столбца `created_at`
     *
     * @return ColumnSchemaBuilder
     */
    public function createdAt()
    {
        return $this->dateTime()->notNull()->defaultExpression('NOW()')->comment('Дата создания');
    }

    /**
     * Набор параметров для формирования типа столбца `updated_at`
     *
     * @return ColumnSchemaBuilder
     */
    public function updatedAt()
    {
        return $this->dateTime()->notNull()->defaultExpression('NOW()')->comment('Дата изменения');
    }
}