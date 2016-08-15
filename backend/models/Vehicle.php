<?php

namespace backend\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vehicle".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string  $frame_number
 * @property Model   $model
 */
class Vehicle extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'frame_number'], 'required'],
            [['model_id'], 'integer'],
            [['frame_number'], 'string', 'min' => 1, 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'frame_number' => Yii::t('app', 'Vehicle frame number'),
        ];
    }

    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }
}
