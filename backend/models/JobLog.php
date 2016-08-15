<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_log".
 *
 * @property integer $id
 * @property integer $job_id
 * @property string $info
 * @property string $created_at
 */
class JobLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'info'], 'required'],
            [['job_id'], 'integer'],
            [['created_at'], 'safe'],
            [['info'], 'string', 'max' => 255],
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
            'info' => 'Info',
            'created_at' => 'Created At',
        ];
    }
}
