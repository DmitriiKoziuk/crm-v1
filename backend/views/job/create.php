<?php

use yii\helpers\Html;

/**
 * @var $this          yii\web\View
 * @var $job           backend\models\Job
 * @var $client        backend\models\Client
 * @var $vehicle       backend\models\Vehicle
 * @var $brand         backend\models\Brand
 * @var $model         backend\models\Model
 * @var $task          backend\models\Task
 * @var $performerList array
 */

$this->title = Yii::t('app', 'New Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'job'           => $job,
        'client'        => $client,
        'vehicle'       => $vehicle,
        'brand'         => $brand,
        'model'         => $model,
        'task'          => $task,
        'performerList' => $performerList,
    ]) ?>

</div>
