<?php

namespace backend\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $phone_number
 */
class Client extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'phone_number'], 'required'],
            [['full_name'], 'string', 'min' => 3, 'max' => 100],
            [['phone_number'], 'string', 'min' => 10, 'max' => 19],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => Yii::t('app', 'Client full name'),
            'phone_number' => Yii::t('app', 'Client phone number'),
        ];
    }
}
