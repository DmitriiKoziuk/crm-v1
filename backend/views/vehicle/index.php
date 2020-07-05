<?php

use backend\models\Vehicle;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VehicleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vehicle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'model_id',
            'frame_number',
            [
                'label' => 'Brand',
                'content' => function ($model) {
                    /** @var Vehicle $model */
                    return ! empty($model->model->brand->name) ? $model->model->brand->name : '';
                }
            ],
            [
                'label' => 'Model',
                'content' => function ($model) {
                    /** @var Vehicle $model */
                    return ! empty($model->model->name) ? $model->model->name : '';
                }
            ],
            'mileage',
            [
                  'attribute' => 'mileage_type',
                  'content' => function ($model) {
                      /** @var Vehicle $model */
                      return $model->getMileageType();
                  }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
