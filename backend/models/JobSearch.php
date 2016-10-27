<?php

namespace backend\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * JobSearch represents the model behind the search form about `backend\models\Job`.
 */
class JobSearch extends Job
{
    public $clientFullName;
    public $clientPhoneNumber;
    public $vehicleFrameNumber;
    public $performerName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'vehicle_id', 'creator_id', 'performer_id'], 'integer'],
            [['clientFullName', 'clientPhoneNumber', 'vehicleFrameNumber', 'performerName'], 'safe'],
        ];
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
        $query = Job::find()->with(['vehicle.model.brand', 'creator'])->orderBy([new Expression('FIELD(job.status, "new", "on-the-job", "pending", "done", "closed")')]);

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
            'performer_id'     => $this->performer_id,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'addition', $this->addition]);

        $query->joinWith(['client' => function ($q) {
            /**
             * @var $q ActiveQuery
             */
            $q->where("client.full_name LIKE '%{$this->clientFullName}%'");
        }]);

        $query->joinWith(['client' => function ($q) {
            /**
             * @var $q ActiveQuery
             */
            $q->where("client.phone_number LIKE '%{$this->clientPhoneNumber}%'");
        }]);

        $query->joinWith(['vehicle' => function ($q) {
            /**
             * @var $q ActiveQuery
             */
            $q->where("vehicle.frame_number LIKE '%{$this->vehicleFrameNumber}%'");
        }]);

        $query->joinWith(['performer' => function ($q) {
            /**
             * @var $q ActiveQuery
             */

            $q->where("user.full_name LIKE '%{$this->performerName}%' OR user.full_name IS null");
        }]);

        return $dataProvider;
    }
}
