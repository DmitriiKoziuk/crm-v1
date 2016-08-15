<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\Job;
use backend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $jobNew     = Job::find()->where(['status' => 'new'])->all();
        $jobInWork  = Job::find()->where(['status' => 'on-the-job'])->all();
        $jobSuspend = Job::find()->where(['status' => 'pending'])->all();

        $freeWorkers = User::find()->select('user.*')->innerJoin('job', '`job`.`performer_id` != `user`.`id`')->all();

        return $this->render('index', [
            'freeWorkers' => $freeWorkers,
            'jobNew'      => $jobNew,
            'jobInWork'   => $jobInWork,
            'jobSuspend'  => $jobSuspend,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCreateRole()
    {
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('accountant');
        $role->description = 'Бухгалтер';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('mechanic');
        $role->description = 'Механик';
        Yii::$app->authManager->add($role);
    }

    public function actionCreatePermission()
    {
        $permit = Yii::$app->authManager->createPermission('deleteJob');
        $permit->description = 'Право удалять Работу';
        Yii::$app->authManager->add($permit);

        $permit = Yii::$app->authManager->createPermission('paymentForJob');
        $permit->description = 'Плата за работу';
        Yii::$app->authManager->add($permit);

        $permit = Yii::$app->authManager->createPermission('editJobAfterPerforming');
        $permit->description = 'Редактировать после выполнения';
        Yii::$app->authManager->add($permit);
    }

    public function actionAddPermissionToRole()
    {
        $role = Yii::$app->authManager->getRole('admin');
        $permission = Yii::$app->authManager->getPermissions();

        foreach ($permission as $permit) {
            Yii::$app->authManager->addChild($role, $permit);
        }

        unset($permission['deleteJob']); unset($permission['editJobAfterPerforming']);

        $role = Yii::$app->authManager->getRole('accountant');

        foreach ($permission as $permit) {
            Yii::$app->authManager->addChild($role, $permit);
        }
    }

    public function actionAddRoleToUser()
    {
        $role = Yii::$app->authManager->getRole('admin');
        Yii::$app->authManager->assign($role, 1);
        Yii::$app->authManager->assign($role, 18);

        $role = Yii::$app->authManager->getRole('accountant');
        Yii::$app->authManager->assign($role, 24);

        $role = Yii::$app->authManager->getRole('mechanic');
        Yii::$app->authManager->assign($role, 19);
        Yii::$app->authManager->assign($role, 20);
        Yii::$app->authManager->assign($role, 21);
        Yii::$app->authManager->assign($role, 22);
        Yii::$app->authManager->assign($role, 23);
    }
}
