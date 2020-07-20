<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Expression;
use backend\models\Model as VehicleModel;

/**
 * JobSearch represents the model behind the search form about `backend\models\Job`.
 */
class JobSearch extends Job
{
    public $clientFullName;
    public $clientPhoneNumber;
    public $vehicleFrameNumber;
    public $performerName;
    public $vehicleBrandId;
    public $vehicleModelId;
    public $jobCreatedFrom;
    public $jobCreatedTo;
    public $jobDoneFrom;
    public $jobDoneTo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'vehicle_id', 'creator_id', 'performer_id'], 'integer'],
            [
                [
                    'clientFullName', 'clientPhoneNumber', 'vehicleFrameNumber', 'performerName',
                    'vehicleBrandId', 'vehicleModelId',
                ], 'safe'
            ],
            [['jobCreatedFrom', 'jobCreatedTo', 'status', 'jobDoneFrom', 'jobDoneTo'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $labels = [
            'vehicleBrandId' => Yii::t('app', 'Vehicle Brand'),
            'vehicleModelId' => Yii::t('app', 'Vehicle Model'),
        ];
        return array_merge($parent, $labels);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Job::find()
            ->with([
                'vehicle.model.brand',
                'creator',
                'client',
                'performer',
            ])
            ->orderBy([new Expression('FIELD(job.status, "new", "on-the-job", "pending", "done", "closed")'), 'pay' => SORT_ASC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'clientFullName' => [
                    'asc' => ['client.full_name' => SORT_ASC],
                    'desc' => ['client.full_name' => SORT_DESC],
                    'label' => 'Client full name'
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'job.id'           => $this->id,
            'status'           => $this->status,
            'performer_id'     => $this->performer_id,
            'creator_id'       => $this->creator_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'addition', $this->addition]);

        if (!empty($this->clientFullName)) {
            $query->joinWith(['client' => function ($q) {
                /**
                 * @var $q ActiveQuery
                 */
                $q->where("client.full_name LIKE '%{$this->clientFullName}%'");
            }]);
        }

        if (!empty($this->clientPhoneNumber)) {
            $query->joinWith(['client' => function ($q) {
                /**
                 * @var $q ActiveQuery
                 */
                $q->where("client.phone_number LIKE '%{$this->clientPhoneNumber}%'");
            }]);
        }

        if (!empty($this->vehicleFrameNumber)) {
            $query->joinWith(['vehicle' => function ($q) {
                /**
                 * @var $q ActiveQuery
                 */
                $q->where("vehicle.frame_number LIKE '%{$this->vehicleFrameNumber}%'");
            }]);
        }

        if (!empty($this->performerName)) {
            $query->joinWith(['performer' => function ($q) {
                /**
                 * @var $q ActiveQuery
                 */

                $q->where("user.full_name LIKE '%{$this->performerName}%' OR user.full_name IS null");
            }]);
        }

        if (!empty($this->vehicleBrandId) && empty($this->vehicleModelId)) {
            $query->innerJoin(
                VehicleModel::tableName(),
                [
                    VehicleModel::tableName() . '.brand_id' => $this->vehicleBrandId,
                ]
            )->innerJoin(
                Vehicle::tableName(),
                [
                    Vehicle::tableName() . '.model_id' =>
                        new Expression(VehicleModel::tableName() . '.id'),
                ]
            )->andWhere([
                Job::tableName() . '.vehicle_id' => new Expression(Vehicle::tableName() . '.id'),
            ]);
        }

        if (!empty($this->vehicleModelId)) {
            $query->innerJoin(
                Vehicle::tableName(),
                [
                    Vehicle::tableName() . '.model_id' => $this->vehicleModelId,
                ]
            )->andWhere([
                Job::tableName() . '.vehicle_id' => new Expression(Vehicle::tableName() . '.id'),
            ]);
        }

        if (!empty($this->jobCreatedFrom)) {
            $query->andWhere(['>=', 'created_at', $this->jobCreatedFrom]);
        }

        if (!empty($this->jobCreatedTo)) {
            $query->andWhere(['<=', 'created_at', $this->jobCreatedTo]);
        }

        if (!empty($this->jobDoneFrom)) {
            $query->andWhere(['>=', 'done_at', $this->jobDoneFrom]);
        }

        if (!empty($this->jobDoneTo)) {
            $query->andWhere(['<=', 'done_at', $this->jobDoneTo]);
        }

        return $dataProvider;
    }
}
