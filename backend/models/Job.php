<?php

namespace backend\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "job".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $vehicle_id
 * @property integer $creator_id
 * @property integer $performer_id
 * @property string  $created_at
 * @property string  $status
 * @property string  $addition
 * @property integer $pay
 * @property string  $done_at
 *
 * @property Client  $client
 * @property Vehicle $vehicle
 * @property User    $creator
 * @property Task[]  $tasks
 * @property Parts[] $parts
 * @property User    $performer
 * @property string  $performerName
 */
class Job extends ActiveRecord
{
    public $imageFiles;

    const SCENARIO_ADD    = 'add';
    const SCENARIO_UPDATE = 'update';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'vehicle_id', 'creator_id'], 'required', 'on' => self::SCENARIO_ADD],
            [['client_id', 'vehicle_id', 'creator_id', 'performer_id', 'pay'], 'integer', 'on' => self::SCENARIO_ADD],
            [['created_at', 'tasks'], 'safe', 'on' => self::SCENARIO_ADD],
            [['status', 'addition'], 'string', 'on' => self::SCENARIO_ADD],
            [['performer_id', 'pay'], 'default', 'value' => 0, 'on' => self::SCENARIO_ADD],
            [['done_at'], 'default', 'value' => NULL, 'on' => self::SCENARIO_ADD],

            [['performer_id'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['performer_id'], 'integer', 'on' => self::SCENARIO_UPDATE],
            [['addition'], 'string', 'on' => self::SCENARIO_UPDATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'client_id'      => 'Client ID',
            'vehicle_id'     => 'Vehicle ID',
            'creator_id'     => 'Creator ID',
            'performer_id'   => Yii::t('app', 'Performer'),
            'created_at'     => Yii::t('app', 'Created At'),
            'done_at'     => Yii::t('app', 'Done At'),
            'status'         => Yii::t('app', 'Status'),
            'addition'       => Yii::t('app', 'Addition'),
            'imageFiles'     => 'Vehicle images',
            'clientFullName' => Yii::t('app', 'Client full name'),
            'clientPhoneNumber' => Yii::t('app', 'Client phone number'),
            'vehicleFrameNumber' => Yii::t('app', 'Vehicle frame number'),
            'modelName' => Yii::t('app', 'Model name'),
            'brandName' => Yii::t('app', 'Brand name'),
            'creatorName' => Yii::t('app', 'Creator name'),
            'performerName' => Yii::t('app', 'Performer name'),
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    public function getVehicle()
    {
        return $this->hasOne(Vehicle::class, ['id' => 'vehicle_id']);
    }

    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    public function getPerformer()
    {
        return $this->hasOne(User::class, ['id' => 'performer_id']);
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class, ['job_id' => 'id']);
    }

    public function getParts()
    {
        return $this->hasMany(Parts::class, ['job_id' => 'id']);
    }

    public function getClientFullName()
    {
        if ($this->client) {
            return $this->client->full_name;
        }
        return '';
    }
    
    public function getClientPhoneNumber()
    {
        if ($this->client) {
            return $this->client->phone_number;
        }
        return '';
    }

    public function getVehicleFrameNumber()
    {
        if ($this->vehicle) {
            return $this->vehicle->frame_number;
        }
        return '';
    }

    public function getModelName()
    {
        if ($this->vehicle) {
            return $this->vehicle->model->name;
        }
        return '';
    }

    public function getBrandName()
    {
        if ($this->vehicle && $this->vehicle->model && $this->vehicle->model->brand) {
            return $this->vehicle->model->brand->name;
        }
        return '';
    }

    public function getCreatorName()
    {
        if ($this->creator) {
            return $this->creator->full_name;
        }
        return '';
    }

    public function getPerformerName()
    {
        if ($this->performer) {
            return $this->performer->full_name;
        }
        return '';
    }

    public function isPerformerSet()
    {
        if (is_null($this->performer)) {
            return false;
        } else {
            return true;
        }
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        if (! isset($this->tasks)) {
            $this->tasks;
        }

        foreach ($this->tasks as $task) {
            /* @var $task Task */
            if ($task->price != 0) {
                $totalPrice += $task->price;
            }
        }

        if (! isset($this->parts)) {
            $this->parts;
        }

        foreach ($this->parts as $part) {
            if ($part->price != 0 && $part->quantity != 0) {
                $totalPrice += ($part->price * $part->quantity);
            }
        }

        return $totalPrice;
    }

    public function getTotalPriceByString()
    {
        $totalPrice = $this->getTotalPrice();

        if (is_float($totalPrice)) {
            $price  = explode('.', number_format($totalPrice, 2, '.', ''));
            $number = Yii::t('app', '{n, spellout}', ['n' => intval($price[0])]);
            return mb_substr($number, 0, 1) . mb_substr($number, 1) . ' ' . Yii::t('app', 'currency') . ' ' . $price[1] . ' ' . Yii::t('app', 'cent');
        } else {
            $number = Yii::t('app', '{n, spellout}', ['n' => $totalPrice]);
            return mb_substr($number, 0, 1) . mb_substr($number, 1) . ' ' . Yii::t('app', 'currency') . ' 00 ' . Yii::t('app', 'cent');
        }
    }

    public function getPerformerPrice()
    {
        $performerPrice = 0;

        if (! isset($this->tasks)) {
            $this->tasks;
        }

        foreach ($this->tasks as $task) {
            /* @var $task Task */
            if ($task->price != 0 && $task->performer_percent != 0) {
                $performerPrice += $task->price * ($task->performer_percent / 100);
            }
        }

        return $performerPrice;
    }

    public function isAllJobsHasPerformerPrice()
    {
        $r = true;
        foreach ($this->tasks as $task) {
            if ($task->performer_percent == 0) {
                $r = false;
            }
        }
        return $r;
    }

    public static function getPerformerList()
    {
        return User::find()->all();
    }

    public function isUserCanSuspend()
    {
        $r = false;

        if (Yii::$app->user->can('suspendJob') && $this->status != 'done') {
            if (Yii::$app->authManager->getAssignment('mechanic', Yii::$app->user->getId())) {
                if ($this->performer_id == Yii::$app->user->getId()) {
                    $r = true;
                }
            } else {
                $r = true;
            }
        }

        return $r;
    }

    public function isUserCanDone()
    {
        $r = false;

        if (Yii::$app->user->can('doneJob') && $this->status != 'done') {
            if (Yii::$app->authManager->getAssignment('mechanic', Yii::$app->user->getId())) {
                if ($this->performer_id == Yii::$app->user->getId()) {
                    $r = true;
                }
            } else {
                $r = true;
            }
        }

        return $r;
    }

    public function isUserCanUpdate()
    {
        $r = false;

        if (Yii::$app->user->can('updateJob')) {
            if (Yii::$app->authManager->getAssignment('mechanic', Yii::$app->user->getId())) {
                if ($this->performer_id == Yii::$app->user->getId()) {
                    $r = true;
                }
            } else {
                $r = true;
            }
        }

        return $r;
    }
}
