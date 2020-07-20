<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\assets\JobIndexAsset;
use backend\models\Job;
use backend\models\Brand;
use backend\models\Model;
use backend\models\JobSearch;

/**
 * @var $this         View
 * @var $searchModel  JobSearch
 * @var $dataProvider ActiveDataProvider
 * @var $vehicleBrands Brand[]
 * @var $vehicleModels Model[]
 */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;

JobIndexAsset::register($this);
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', [
        'searchModel' => $searchModel,
        'vehicleBrands' => $vehicleBrands,
        'vehicleModels' => $vehicleModels,
    ]); ?>

    <p>
      <?= Html::a(Yii::t('app', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>

      <button
              class="btn btn-default"
              type="button"
              data-toggle="collapse"
              data-target="#collapseExample"
              aria-expanded="false"
              aria-controls="collapseExample"
      >
        Поиск
      </button>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view job-list'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            /* @var $model Job */
            $class = $model->status;

            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => function ($model) {
                    /* @var $model Job */
                    return [
                        'class' => 'link-to',
                        'data-href' => Url::to(['/job/update', 'id' => $model->id])
                    ];
                }
            ],
            [
                'attribute' => 'clientFullName',
                'content'   => function ($model) {
                    /* @var $model Job */
                    return str_replace(' ', '<br>', $model->getClientFullName());
                },
                'contentOptions' => function ($model) {
                    /* @var $model Job */
                    return [
                        'class' => 'link-to',
                        'data-href' => Url::to(['/job/view', 'id' => $model->id])
                    ];
                },
                'filter' => false,
            ],
            [
                'attribute' => 'clientPhoneNumber',
                'content'   => function ($model) {
                    /* @var $model Job */
                    if ($model->client) {
                        return preg_replace("/([+]{1})([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1$2 ($3) $4-$5-$6", $model->client->phone_number);
                    }
                    return '';
                },
                'filter' => false,
            ],
            [
                'attribute' => 'vehicleFrameNumber',
                'filter' => false,
            ],
            [
                'attribute' => 'Vehicle',
                'content'   => function ($model) {
                    /* @var $model Job */
                    return $model->getBrandName() . '<br>' . $model->getModelName();
                },
                'filter' => false,
            ],
            [
                'attribute' => 'creatorName',
                'content'   => function ($model) {
                    /* @var $model Job */
                    return str_replace(' ', '<br>', $model->getCreatorName());
                },
                'filter' => false,
            ],
            [
                'attribute' => 'performer_id',
                'content'   => function ($model) {
                    /* @var $model Job */
                    return str_replace(' ', '<br>', $model->getPerformerName());
                },
                'filter' => false,
            ],
            'created_at:date',
            [
                'attribute' => 'status',
                'content'   => function ($model) {
                    return Html::tag('span', Yii::t('app', $model->status), ['class' => 'job-status ' . $model->status]);
                },
                'filter' => false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {print}',
                'buttons'  => [
                    'print' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
