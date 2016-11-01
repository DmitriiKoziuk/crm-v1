<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use backend\models\Job;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\models\JobSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        backend\models\Job
 */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['action' => '/job/pay']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view job-list'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            /* @var $model \backend\models\Job */
            $class = $model->status;

            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'clientFullName',
                'content'   => function ($model) {
                    /* @var $model \backend\models\Job */
                    return str_replace(' ', '<br>', $model->getClientFullName());
                }
            ],
            [
                'attribute' => 'clientPhoneNumber',
                'content'   => function ($model) {
                    return preg_replace("/([+]{1})([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1$2 ($3) $4-$5-$6", $model->client->phone_number);
                }
            ],
            'vehicleFrameNumber',
            [
                'attribute' => 'Vehicle',
                'content'   => function ($model) {
                    /* @var $model \backend\models\Job */
                    return $model->getBrandName() . '<br>' . $model->getModelName();
                }
            ],
            [
                'attribute' => 'creatorName',
                'content'   => function ($model) {
                    /* @var $model \backend\models\Job */
                    return str_replace(' ', '<br>', $model->getCreatorName());
                }
            ],
            [
                'attribute' => 'performer_id',
                'content'   => function ($model) {
                    /* @var $model \backend\models\Job */
                    return str_replace(' ', '<br>', $model->getPerformerName());
                },
                'filter' => ArrayHelper::map(Job::getPerformerList(), 'id', 'full_name'),
            ],
            //'client_id',
            //'vehicle_id',
            //'creator_id',
            'created_at:date',
            'done_at:date',
            [
                'attribute' => 'status',
                'content'   => function ($model) {
                    return Html::tag('span', Yii::t('app', $model->status), ['class' => 'job-status ' . $model->status]);
                }
            ],
            //'status',
            // 'addition:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {print} {pay}',
                'buttons'  => [
                    'print' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url);
                    },
                    'pay' => function ($url, $model) use ($form) {
                        /* @var $model \backend\models\Job */
                        if ($model->pay == '0') {
                            return $form->field($model, "[{$model->id}]pay")->checkbox() . $model->getPerformerPrice() . ($model->isAllJobsHasPerformerPrice() ? '' : ' <span style="color:red; font-weight: bold">!</span>');
                        } else {
                            return '<div class="job-status paid">paid</div>';
                        }
                    }
                ],
            ],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Pay', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>