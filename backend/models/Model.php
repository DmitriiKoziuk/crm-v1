<?php

namespace backend\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "model".
 *
 * @property integer $id
 * @property integer $brand_id
 * @property string  $name
 * @property Brand   $brand
 */
class Model extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'name'], 'required'],
            [['brand_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_id' => 'Brand ID',
            'name' => Yii::t('app', 'Model name')
        ];
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
}
