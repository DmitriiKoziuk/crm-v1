<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\CreateJobAsset;
use unclead\widgets\MultipleInput;
use unclead\widgets\TabularInput;
use backend\models\Task;
use backend\models\Parts;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @var $this          yii\web\View
 * @var $job           backend\models\Job
 * @var $taskList      array
 * @var $partsList     array
 * @var $performerList array
 */

$this->title = Yii::t('app', 'Update Job') . ': ' . $job->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $job->id, 'url' => ['view', 'id' => $job->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

CreateJobAsset::register($this);
?>
<div class="job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin() ?>

    <div class="row client-info">
        <div class="col-md-8">
            <?= $form->field($job->client, 'full_name')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($job->client, 'phone_number')
                ->textInput(
                    [
                        'disabled' => true,
                        'class' => 'form-control bfh-phone',
                        'data-format' => '+380 (dd) ddd-dd-dd',
                        'data-number' => ''
                    ]
                )
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($job->vehicle, 'frame_number')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($job->vehicle->model->brand, 'name')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($job->vehicle->model, 'name')->textInput(['disabled' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($job, 'performer_id')
                ->dropDownList(ArrayHelper::map($performerList, 'id', 'full_name'), ['prompt' => ''])
            ?>
        </div>
    </div>

    <div class="task-wrapper">
        <div class="task">
            <span class="line"></span>
            <span class="title"><?= Yii::t('app', 'Tasks') ?></span>
        </div>

        <div class="list">
            <?= TabularInput::widget([
                'models' => count($taskList) != 0 ? $taskList : [0 => new Task()],
                'columns' => [
                    [
                        'name'  => 'id',
                        'title' => 'Id',
                        'type'  => 'textInput',
                        'options' => ['style' => 'display:none;'],
                        'headerOptions' => ['style' => 'display:none;'],
                        'value' => function ($data) {
                            return $data->id;
                        }
                    ],
                    [
                        'name'  => 'name',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Name'),
                        'value' => function ($data) {
                            return $data->name;
                        }
                    ],
                    [
                        'name'  => 'price',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Price'),
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value' => function ($data) {
                            return $data->price;
                        }
                    ],
                    [
                        'name'  => 'performer_percent',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Performer percent'),
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value' => function ($data) {
                            return $data->performer_percent;
                        }
                    ],
                    [
                        'name'          => 'performer_get',
                        'type'          => 'textInput',
                        'title'         => Yii::t('app', 'Performer get'),
                        'options'       => ['disabled' => true],
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value'         => function ($data) {
                            if ($data->price != 0 && $data->performer_percent != 0) {
                                return $data->price * ($data->performer_percent / 100);
                            } else {
                                return '';
                            }
                        },
                    ],
                ],
            ]) ?>

            <div class="total">
                <div class="price">
                    <div>Исполнитель получит: <?= number_format($job->getPerformerPrice(), 2, '.', ' ') ?> грн.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="task-wrapper">
        <div class="task">
            <span class="line"></span>
            <span class="title"><?= Yii::t('app', 'Parts') ?></span>
        </div>

        <div class="list">
            <?= TabularInput::widget([
                'models' => count($partsList) != 0 ? $partsList : [0 => new Parts()],
                'columns' => [
                    [
                        'name'  => 'id',
                        'title' => 'Id',
                        'type'  => 'textInput',
                        'options' => ['style' => 'display:none;'],
                        'headerOptions' => ['style' => 'display:none;'],
                        'value' => function ($data) {
                            return $data->id;
                        }
                    ],
                    [
                        'name'  => 'name',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Name'),
                        'value' => function ($data) {
                            return $data->name;
                        }
                    ],
                    [
                        'name'  => 'quantity',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Quantity'),
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value' => function ($data) {
                            return $data->quantity;
                        }
                    ],
                    [
                        'name'  => 'price',
                        'type'  => 'textInput',
                        'title' => Yii::t('app', 'Price for item'),
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value' => function ($data) {
                            return $data->price;
                        }
                    ],
                    [
                        'name'          => 'totalPrice',
                        'type'          => 'textInput',
                        'title'         => Yii::t('app', 'Total price'),
                        'options'       => ['disabled' => true],
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value'         => function ($data) {
                            if ($data->quantity != 0) {
                                return ($data->price * $data->quantity);
                            } else {
                                return 0;
                            }
                        },
                    ],
                ],
            ]) ?>

            <div class="total">
                <div class="price">
                    <div>Всего к оплате: <?= number_format($job->getTotalPrice(), 2, '.', ' ') ?> грн.</div>
                </div>
            </div>
        </div>

        <div class="task">
            <span class="line"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($job, 'addition')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>

    <div class="form-group">
        <?php if ($job->isUserCanUpdate()): ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $job->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>

        <?= Html::a(Yii::t('app', 'Print invoice'), Url::to(['print', 'id' => $job->id]), ['class' => 'btn btn-info']) ?>
    </div>

    <?php $form->end() ?>

</div>
