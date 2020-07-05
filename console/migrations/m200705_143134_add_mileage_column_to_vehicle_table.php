<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vehicle}}`.
 */
class m200705_143134_add_mileage_column_to_vehicle_table extends Migration
{
    private $vehicleTableName = 'vehicle';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            $this->vehicleTableName,
            'mileage',
            $this->integer()->notNull()->defaultValue(0)
        );
        $this->addColumn(
            $this->vehicleTableName,
            'mileage_type',
            $this->tinyInteger()->notNull()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->vehicleTableName, 'mileage_type');
        $this->dropColumn($this->vehicleTableName, 'mileage');
    }
}
