<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'full_name',
            [
                'attribute' => 'photo',
                'content'   => function ($model) {
                    /**
                     * @var User $model
                     */
                    if ($model->isPhoto()) {
                        return Html::img($model->getPhotoPreview(150, 150));
                    }
                }
            ],
            [
                'attribute' => 'toPay',
                'content'   => function ($model) {
                    /* @var $model User */
                    return number_format($model->getToPay(), 2, '.', ' ');
                }
            ],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{pay} {view} {update} {delete}',
                'buttons'  => [
                    'pay' => function ($url, $model) {
                        /* @var $model User */
                        return Html::a('<span class="glyphicon glyphicon-usd"></span>', ['/job/pay-for-job-form', 'JobSearch[performer_id]' => $model->id]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
