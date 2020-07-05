<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "parts".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string  $name
 * @property double  $price
 * @property integer $quantity
 * @property integer $code
 */
class Parts extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'name'], 'required'],
            [['job_id', 'quantity', 'code'], 'integer'],
            [['name'], 'string'],
            [['price'], 'number'],
            [['price', 'code'], 'default', 'value' => 0],
            [['quantity'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'name' => 'Name',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'code' => 'Code',
        ];
    }
}
