<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parts}}`.
 */
class m200705_140812_add_code_column_to_parts_table extends Migration
{
    private $partsTableName = 'parts';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            $this->partsTableName,
            'code',
            $this->integer()->notNull()->defaultValue(0)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->partsTableName, 'code');
    }
}
