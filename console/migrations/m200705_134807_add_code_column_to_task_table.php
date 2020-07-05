<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%task}}`.
 */
class m200705_134807_add_code_column_to_task_table extends Migration
{
    private $taskTableName = 'task';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            $this->taskTableName,
            'code',
            $this->integer()->notNull()->defaultValue(0)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->taskTableName, 'code');
    }
}
