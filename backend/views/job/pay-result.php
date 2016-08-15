<?php

use yii\grid\GridView;

/**
 * @var $this         yii\web\View
 * @var $dataProvider backend\models\Job[]
 * @var $toPay        integer
 */
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
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
                /* @var $model backend\models\Job */
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
            'attribute' => 'toPay',
            'content'   => function ($model) {
                /* @var $model \backend\models\Job */
                return $model->getPerformerPrice();
            }
        ],
    ],
]) ?>

<div>
    Всего к оплате: <?= $toPay ?>
</div>
