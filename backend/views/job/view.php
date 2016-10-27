<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var $this      yii\web\View
 * @var $job       backend\models\Job
 * @var $task      backend\models\Task
 * @var $userRoles yii\rbac\Role[]
 */

$this->title = $job->id;
$this->params['breadcrumbs'][] = ['label' => 'Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1>Заказ-наряд № <?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $job,
        'attributes' => [
            [
                'label' => Yii::t('app', 'Client full name'),
                'value' => $job->client->full_name
            ],
            [
                'label' => Yii::t('app', 'Client phone number'),
                'value' => preg_replace('/([+]{1})([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/', '$1$2 ($3) $4-$5-$6', $job->client->phone_number)
            ],
            [
                'label' => Yii::t('app', 'Brand name') . ' ' . Yii::t('app', 'Model name'),
                'value' => $job->vehicle->model->brand->name . ' ' . $job->vehicle->model->name
            ],
            [
                'label' => Yii::t('app', 'Vehicle frame number'),
                'value' => $job->vehicle->frame_number
            ],
            [
                'label' => Yii::t('app', 'Performer name'),
                'value' => $job->performerName
            ],
            'created_at:date',
        ],
    ]) ?>

    <table class="table table-striped table-bordered task-list">
        <thead>
            <tr>
                <td>№</td>
                <td class="name"><?= Yii::t('app', 'Tasks') ?></td>
                <td class="price"><?= Yii::t('app', 'Task price') ?></td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($job->tasks as $taskKey => $task) : ?>
            <tr>
                <th><?= ++$taskKey ?></th>
                <td><?= $task->name ?></td>
                <td class="price"></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php $form = ActiveForm::begin() ?>

                    <?= $form->field($job, 'addition')->textarea(['disabled' => true]) ?>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>

    <div class="row action-btn">
        <div class="col-md-8">
            <?php if (! $job->isPerformerSet()): ?>
                <?= Html::a(Yii::t('app', 'On the job'), ['/job/take-job', 'id' => $job->id], ['class' => 'btn btn-info']) ?>
            <?php endif; ?>

            <?php if (($job->performer_id == Yii::$app->user->identity->getId() || $job->creator_id == Yii::$app->user->identity->getId()) && ($job->status == 'pending' || $job->status == 'new') && $job->status != 'done'): ?>
                <?= Html::a(Yii::t('app', 'To work'), ['/job/to-work', 'id' => $job->id], ['class' => 'btn btn-info']) ?>
            <?php endif; ?>

            <?php if ($job->isUserCanDone()): ?>
                <?= Html::a(Yii::t('app', 'Done'), ['/job/done', 'id' => $job->id], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>

            <?php if ($job->isUserCanSuspend()): ?>
                <?= Html::a(Yii::t('app', 'Suspend'), ['/job/suspend', 'id' => $job->id], ['class' => 'btn btn-warning']) ?>
            <?php endif; ?>

            <?php if (Yii::$app->user->can('closeJob')): ?>
                <?= Html::a(Yii::t('app', 'Close'), ['/job/close', 'id' => $job->id], ['class' => 'btn btn-danger']) ?>
            <?php endif; ?>
        </div>
        <div class="col-md-4 right-btn">
            <?= Html::a(Yii::t('app', 'Print invoice'), Url::to(['print', 'id' => $job->id]), ['class' => 'btn btn-info']) ?>

            <?php if($job->status != 'done'): ?>
                <?php if($job->creator_id == Yii::$app->user->identity->getId() || $job->isPerformerSet() && $job->performer_id == Yii::$app->user->identity->getId()): ?>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $job->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $job->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
