<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string  $name
 * @property float   $price
 * @property integer $performer_percent
 * @property integer $code
 */
class Task extends ActiveRecord
{
    public $taskList = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'name'], 'required'],
            [['job_id', 'performer_percent', 'code'], 'integer'],
            [['price'], 'double'],
            [['job_id', 'performer_percent', 'price', 'code'], 'default', 'value' => 0],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'job_id'            => 'Job ID',
            'name'              => 'Name',
            'price'             => 'Price',
            'performer_percent' => 'Performer percent',
            'code'              => 'Code'
        ];
    }
}
