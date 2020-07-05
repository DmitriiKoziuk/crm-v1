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
 * @property integer $mileage
 * @property integer $mileage_type
 */
class Vehicle extends ActiveRecord
{
    const MILEAGE_TYPE_MILES = 1;
    const MILEAGE_TYPE_HOURS = 2;

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
            [['model_id', 'mileage', 'mileage_type'], 'integer'],
            [['frame_number'], 'string', 'min' => 1, 'max' => 20],
            [['mileage'], 'default', 'value' => 0],
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
            'mileage' => Yii::t('app', 'Mileage'),
            'mileage_type' => Yii::t('app', 'Mileage Type'),
        ];
    }

    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }

    public static function getMileAgeTypes(): array
    {
        return [
            self::MILEAGE_TYPE_MILES => Yii::t('app', 'Mileage'),
            self::MILEAGE_TYPE_HOURS => Yii::t('app', 'Working Hours'),
        ];
    }

    public function getMileageType()
    {
        if ($this->mileage_type) {
            return $this::getMileAgeTypes()[ $this->mileage_type ];
        }
        return '';
    }
}
