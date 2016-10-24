<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $status          = false;
        $model           = new User();
        $model->scenario = User::SCENARIO_ADD;
        $roleList        = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
        $userRole        = [];

        if ( Yii::$app->request->isPost ) {
            if ( $model->load( Yii::$app->request->post() ) ) {
                $model->email  = rand(1, 5000) . '@' . rand(1, 5000) . '.gmail.com';
                $model->status = 10;
                $model->photo  = '';
                $model->setPassword($model->password);
                $model->generateAuthKey();

                if ($model->validate()) {
                    if ($model->insert()) {
                        $model->uploadPhoto();

                        $status = true;
                    }
                }

                $newUserRoles = Yii::$app->request->post('role');
                $tmp          = [];
                foreach ($newUserRoles as $newUserRole) {
                    $tmp[ $newUserRole ] = $newUserRole;
                }
                $newUserRoles = $tmp;

                foreach ($userRole as $roleName => $data) {
                    if (key_exists($roleName, $newUserRoles)) {
                        unset($newUserRoles[ $roleName ]);
                    } else {
                        $role = Yii::$app->authManager->getRole($roleName);
                        Yii::$app->authManager->revoke($role, $model->id);
                    }
                }

                foreach ($newUserRoles as $roleName) {
                    $role = Yii::$app->authManager->getRole($roleName);
                    Yii::$app->authManager->assign($role, $model->id);
                    $userRole[ $roleName ] = $roleName;
                }
            }
        }

        if ($status) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'roleList' => $roleList,
                'userRole' => $userRole,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model           = $this->findModel($id);
        $status          = false;
        $roleList        = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
        $userRole        = ArrayHelper::map(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()), 'name', 'name');

        if (Yii::$app->request->isPost) {
            $model->scenario = User::SCENARIO_UPDATE;
            if ($model->load(Yii::$app->request->post())) {
                if ($model->isAttributeChanged('username')) {
                    $model->scenario = User::SCENARIO_UPDATE_LOGIN;
                    if ($model->validate()) {}
                }

                if ($model->isAttributeChanged('full_name')) {
                    $model->scenario = User::SCENARIO_UPDATE_FULLNAME;
                    if ($model->validate()) {}
                }

                if (! is_null($model->password)) {
                    $model->scenario = User::SCENARIO_UPDATE_PASSWORD;
                    if ($model->validate()) {
                        $model->setPassword($model->password);
                        $model->generateAuthKey();
                    }
                }

                if ($model->save()) {
                    $status = true;
                }

                $newUserRoles = Yii::$app->request->post('role');
                $tmp          = [];
                foreach ($newUserRoles as $newUserRole) {
                    $tmp[ $newUserRole ] = $newUserRole;
                }
                $newUserRoles = $tmp;

                foreach ($userRole as $roleName => $data) {
                    if (key_exists($roleName, $newUserRoles)) {
                        unset($newUserRoles[ $roleName ]);
                    } else {
                        $role = Yii::$app->authManager->getRole($roleName);
                        Yii::$app->authManager->revoke($role, Yii::$app->user->getId());
                    }
                }

                foreach ($newUserRoles as $roleName) {
                    $role = Yii::$app->authManager->getRole($roleName);
                    Yii::$app->authManager->assign($role, Yii::$app->user->getId());
                    $userRole[ $roleName ] = $roleName;
                }
            }
        }
        if ($status) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'roleList' => $roleList,
                'userRole' => $userRole,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
