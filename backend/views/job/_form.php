<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use backend\assets\CreateJobAsset;
use unclead\multipleinput\MultipleInput;

/**
 * @var $this          yii\web\View
 * @var $job           backend\models\Job
 * @var $form          yii\widgets\ActiveForm
 * @var $client        backend\models\Client
 * @var $vehicle       backend\models\Vehicle
 * @var $brand         backend\models\Brand
 * @var $model         backend\models\Model
 * @var $task          backend\models\Task
 * @var $parts         backend\models\Parts
 * @var $performerList array
 */

CreateJobAsset::register($this);
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row client-info">
        <div class="col-md-8">
            <?= $form->field($client, 'full_name')->widget(Select2::classname(), [
                'initValueText' => $client->full_name, // set the initial display text
                'options' => ['placeholder' => 'Search for a client ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'maximumInputLength' => 100,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/client/get-list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(client) { return client.full_name; }'),
                    'templateSelection' => new JsExpression('function (client) { 
                        if ("phone_number" in client) {
                            $("input[name=\'Client[phone_number]\']").val(client.phone_number).keyup();
                        }
                        return client.full_name; 
                    }'),
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($client, 'phone_number')
                ->textInput(['class' => 'form-control bfh-phone', 'data-format' => '+380 (dd) ddd-dd-dd', 'data-number' => ''])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($vehicle, 'frame_number')->widget(Select2::classname(), [
                'initValueText' => $vehicle->frame_number, // set the initial display text
                'options' => ['placeholder' => 'Search for a frame number ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'maximumInputLength' => 20,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/vehicle/get-list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(vehicle) { return vehicle.frame_number; }'),
                    'templateSelection' => new JsExpression('function (vehicle) { return vehicle.frame_number; }'),
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($brand, 'name')->widget(Select2::classname(), [
                'initValueText' => $brand->name, // set the initial display text
                'options' => ['placeholder' => 'Search for a brand ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'maximumInputLength' => 100,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/brand/get-list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(brand) { return brand.name; }'),
                    'templateSelection' => new JsExpression('function (brand) { return brand.name; }'),
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'name')->widget(Select2::classname(), [
                'value' => 'hello',
                'initValueText' => 'hello',
                'options' => ['placeholder' => 'Search for a model ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 2,
                    'maximumInputLength' => 100,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(['/model/get-list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(model) { return model.name; }'),
                    'templateSelection' => new JsExpression('function (model) { return model.name; }'),
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($job, 'performer_id')
                ->dropDownList(ArrayHelper::map($performerList, 'id', 'full_name'), ['prompt' => '']) ?>
        </div>
    </div>


    <div class="task-wrapper">
        <div class="task">
            <span class="line"></span>
            <span class="title"><?= Yii::t('app', 'Tasks') ?></span>
        </div>

        <div class="list">
            <?= $form->field($task, 'name')->widget(MultipleInput::className(), [
                'max'             => 30,
                'allowEmptyList'    => false,
                'enableGuessTitle'  => true,
                'min'               => 1, // should be at least 2 rows
                'addButtonPosition' => MultipleInput::POS_ROW // show add button in the header
            ])->label(false);
            ?>
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
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => $job->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
