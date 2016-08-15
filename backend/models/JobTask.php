<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_task".
 *
 * @property integer $id
 * @property integer $act_id
 * @property integer $job_id
 */
class JobTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_id', 'job_id'], 'required'],
            [['act_id', 'job_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'act_id' => 'Act ID',
            'job_id' => 'Job ID',
        ];
    }
}
