<?php

use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use backend\models\Brand;
use backend\models\Model;
use backend\models\Job;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
/**
 * @var $vehicleBrands Brand[]
 * @var $vehicleModels Model[]
 */
?>

<div class="job-search">
  <div class="collapse" id="collapseExample">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-4">
          <?= $form->field($searchModel, 'clientFullName')->widget(Select2::class, [
              'options' => ['placeholder' => 'Search for a client ...'],
              'pluginOptions' => [
                  'allowClear' => true,
                  'minimumInputLength' => 1,
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
          <?= $form->field($searchModel, 'clientPhoneNumber') ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
          <?= $form->field($searchModel, 'performer_id')
              ->dropDownList(
                  ArrayHelper::map(Job::getPerformerList(), 'id', 'full_name'),
                  [
                      'prompt' => '',
                  ]
              )
          ?>
      </div>
      <div class="col-md-4">
          <?= $form->field($searchModel, 'creator_id')
              ->dropDownList(
                  ArrayHelper::map(Job::getPerformerList(), 'id', 'full_name'),
                  [
                      'prompt' => '',
                  ]
              )
              ->label('Создал')
          ?>
      </div>
      <div class="col-md-4">
          <?= $form->field($searchModel, 'status')->dropDownList(
              [
                  'new' => 'new',
                  'on-the-job' => 'on-the-job',
                  'pending' => 'pending',
                  'done' => 'done',
                  'closed' => 'closed',
              ],
              [
                  'prompt' => '',
              ]
          ) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <?= $form->field($searchModel, 'vehicleBrandId')
            ->widget(Select2::class, [
                'data' => ArrayHelper::map($vehicleBrands, 'id', 'name'),
                'options' => [
                    'id' => 'vehicleBrandId',
                    'placeholder' => 'Select a state ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
      </div>
      <div class="col-md-4">
        <?= $form->field($searchModel, 'vehicleModelId')
            ->widget(DepDrop::class, [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => ArrayHelper::map($vehicleModels, 'id', 'name'),
                'pluginOptions'=> [
                    'depends' => ['vehicleBrandId'],
                    'placeholder' => 'Select...',
                    'url' => Url::to(['/vehicle/brand-vehicles'])
                ]
            ]);
        ?>
      </div>
      <div class="col-md-4">
          <?= $form->field($searchModel, 'vehicleFrameNumber') ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
          <?= $form->field($searchModel, 'jobCreatedFrom')->widget(DatePicker::class, [
              'type' => DatePicker::TYPE_COMPONENT_PREPEND,
              'pluginOptions' => [
                  'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
                  'convertFormat' => true,
              ]
          ])->label('Создан от') ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'jobCreatedTo')->widget(DatePicker::class, [
              'type' => DatePicker::TYPE_COMPONENT_PREPEND,
              'pluginOptions' => [
                  'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
                  'convertFormat' => true,
              ]
          ])->label('Создан до') ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'jobDoneFrom')->widget(DatePicker::class, [
              'type' => DatePicker::TYPE_COMPONENT_PREPEND,
              'pluginOptions' => [
                  'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
                  'convertFormat' => true,
              ]
          ])->label('Выполнен от') ?>
      </div>
      <div class="col-md-3">
          <?= $form->field($searchModel, 'jobDoneTo')->widget(DatePicker::class, [
              'type' => DatePicker::TYPE_COMPONENT_PREPEND,
              'pluginOptions' => [
                  'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
                  'convertFormat' => true,
              ]
          ])->label('Выполнен до') ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
