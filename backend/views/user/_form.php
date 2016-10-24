<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/**
 * @var $this yii\web\View
 * @var $model backend\models\User
 * @var $form yii\widgets\ActiveForm
 * @var $roleList array
 * @var $userRole array
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'photo')->fileInput() ?>

    <div class="form-group field-user-password">
        <?php
        echo '<label class="control-label">Tag Multiple</label>';
        echo Select2::widget([
            'name' => 'role',
            'value' => $userRole, // initial value
            'data' => $roleList,
            'options' => ['placeholder' => 'Select a role ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
