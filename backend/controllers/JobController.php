<?php

namespace backend\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\data\ArrayDataProvider;
use backend\models\Job;
use backend\models\JobSearch;
use backend\models\Client;
use backend\models\Vehicle;
use backend\models\Brand;
use backend\models\Model;
use backend\models\Task;
use backend\models\Parts;
use backend\models\User;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
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
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $job       = Job::find()->where(['id' => $id])->one();
        $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

        if (is_null($job)) {
            throw new NotFoundHttpException();
        } else {
            return $this->render('view', [
                'job' =>$job,
                'userRoles' => $userRoles,
            ]);
        }
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $status        = false;
        $client        = new Client();
        $vehicle       = new Vehicle();
        $brand         = new Brand();
        $model         = new Model();
        $task          = new Task();
        $parts         = new Parts();
        $job           = new Job();
        $job->scenario = Job::SCENARIO_ADD;
        $performerList = User::find()->all();

        if (
            $client->load(Yii::$app->request->post())  &&
            $vehicle->load(Yii::$app->request->post()) &&
            $brand->load(Yii::$app->request->post())   &&
            $model->load(Yii::$app->request->post())   &&
            $task->load(Yii::$app->request->post())
        ) {
            if ($client->validate()) {
                $client->phone_number = preg_replace('/[ ()-]/', '', $client->phone_number);
                /**
                 * @var $isExist Client
                 */
                $isExist = Client::find()->where(['full_name' => $client->full_name])->one();
                if (is_null($isExist)) {
                    $client->insert();
                } else {
                    $client->id = $isExist->id;
                }
            }

            if ($brand->validate()) {
                /**
                 * @var $isExist Brand
                 */
                $isExist = Brand::find()->where(['name' => $brand->name])->one();
                if (is_null($isExist)) {
                    $brand->insert();
                } else {
                    $brand->id = $isExist->id;
                }
                $model->brand_id = $brand->id;

                if ($model->validate()) {
                    /**
                     * @var $isExist Model
                     */
                    $isExist = Model::find()->where(['name' => $model->name, 'brand_id' => $brand->id])->one();
                    if (is_null($isExist)) {
                        $model->insert();
                    } else {
                        $model->id = $isExist->id;
                    }
                    $vehicle->model_id = $model->id;

                    if ($vehicle->validate()) {
                        /**
                         * @var $isExist Vehicle
                         */
                        $isExist = Vehicle::find()
                            ->where(['frame_number' => $vehicle->frame_number, 'model_id' => $vehicle->model_id])
                            ->one();
                        if (is_null($isExist)) {
                            $vehicle->insert();
                        } else {
                            $vehicle->id = $isExist->id;
                        }
                    }
                }
            }

            if ($job->load(Yii::$app->request->post())) {
                $job->client_id  = $client->id;
                $job->vehicle_id = $vehicle->id;
                $job->creator_id = Yii::$app->user->identity->getId();
                $job->created_at = new Expression('NOW()');
                $job->status     = 'new';

                if ( $job->validate() && isset($_POST['Task']['name']) ) {
                    if ($job->insert()) {
                        $taskNumber = 0;
                        foreach ($_POST['Task']['name'] as $taskName) {
                            if ($taskName != '') {
                                $taskNumber++;

                                $newTask         = new Task();
                                $newTask->job_id = $job->id;
                                $newTask->name   = $taskName;

                                if ($newTask->validate()) {
                                    $newTask->insert();
                                }
                            }
                        }

                        $status = true;
                    }
                }
            }
        }

        if ($status) {
            return $this->redirect(['view', 'id' => $job->id]);
        } else {
            return $this->render('create', [
                'job'           => $job,
                'client'        => $client,
                'vehicle'       => $vehicle,
                'brand'         => $brand,
                'model'         => $model,
                'task'          => $task,
                'parts'         => $parts,
                'performerList' => $performerList,
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /**
         * @var $job Job
         */
        $job           = Job::find()
            ->where(['id' => $id])
            ->with(['client', 'vehicle.model.brand', 'tasks', 'parts'])
            ->one();
        $performerList = User::find()->all();

        if (Yii::$app->request->isPost) {
            $updateTask = Yii::$app->request->post('Task');

            foreach ($updateTask as $index => $uTask) {
                if ($uTask['id'] == '') {
                    $newTask                    = new Task();
                    $newTask->job_id            = $job->id;
                    $newTask->name              = $uTask['name'];
                    $newTask->price             = $uTask['price'];
                    $newTask->performer_percent = $uTask['performer_percent'];
                    $newTask->code              = $uTask['code'];
                    $newTask->save();

                    unset($updateTask[ $index ]);
                }
            }
            
            foreach ($job->tasks as $task) {
                /* @var $task Task */
                $delete = true;
                foreach ($updateTask as $uTask) {
                    if ($task->id == $uTask['id']) {
                        $delete = false;
                        if ($task->name != $uTask['name']) {
                            $task->name = $uTask['name'];
                        }
                        if ($task->price != $uTask['price']) {
                            $task->price = $uTask['price'];
                        }
                        if ($task->performer_percent != $uTask['performer_percent']) {
                            $task->performer_percent = $uTask['performer_percent'];
                        }
                        if ($task->code != $uTask['code']) {
                            $task->code = $uTask['code'];
                        }
                        $task->save();
                    }
                }
                if ($delete) {
                    $task->delete();
                }
            }

            unset($job->tasks);
            $job->tasks;

            $updateParts = Yii::$app->request->post('Parts');

            foreach ($updateParts as $index => $uPart) {
                if ($uPart['id'] == '') {
                    $newPart                    = new Parts();
                    $newPart->job_id            = $job->id;
                    $newPart->name              = $uPart['name'];
                    $newPart->price             = $uPart['price'];
                    $newPart->quantity          = $uPart['quantity'];
                    $newPart->code              = $uPart['code'];
                    $newPart->save();

                    unset($updateParts[ $index ]);
                }
            }

            foreach ($job->parts as $part) {
                /* @var $task Task */
                $delete = true;
                foreach ($updateParts as $uPart) {
                    if ($part->id == $uPart['id']) {
                        $delete = false;
                        if ($part->name != $uPart['name']) {
                            $part->name = $uPart['name'];
                        }
                        if ($part->price != $uPart['price']) {
                            $part->price = $uPart['price'];
                        }
                        if ($part->quantity != $uPart['quantity']) {
                            $part->quantity = $uPart['quantity'];
                        }
                        if ($part->code != $uPart['code']) {
                            $part->code = $uPart['code'];
                        }
                        $part->save();
                    }
                }
                if ($delete) {
                    $part->delete();
                }
            }

            unset($job->parts);
            $job->parts;

            $job->scenario = Job::SCENARIO_UPDATE;
            if ($job->load(Yii::$app->request->post()) && $job->validate()) {
                $job->save();
            }

            $vehicle = Yii::$app->request->post('Vehicle');
            if ($job->vehicle->mileage != $vehicle['mileage']) {
                $job->vehicle->mileage = $vehicle['mileage'];
            }
            if ($job->vehicle->mileage_type != $vehicle['mileage_type']) {
                $job->vehicle->mileage_type = $vehicle['mileage_type'];
            }
            $job->vehicle->save();
        }

        $taskList = [];
        foreach ($job->tasks as $task) {
            /* @var $task Task */
            $taskList[] = clone $task;
        }

        $partsList = [];
        foreach ($job->parts as $part) {
            /* @var $task Task */
            $partsList[] = clone $part;
        }

        $userRoles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

        if ($job->status == 'done' && isset($userRoles['mechanic'])) {
            return $this->redirect(['view', 'id' => $job->id]);
        } else {
            return $this->render('update', [
                'job'           => $job,
                'taskList'      => $taskList,
                'partsList'     => $partsList,
                'performerList' => $performerList,
            ]);
        }
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTakeJob($id)
    {
        $job = Job::findOne($id);

        if ($job->performer_id == 0 || $job->performer_id == Yii::$app->user->identity->getId()) {
            $job->performer_id = Yii::$app->user->identity->getId();
            $job->status       = 'on-the-job';
            $job->save();
        }

        return $this->redirect(['view', 'id' => $job->id]);
    }

    public function actionSuspend($id)
    {
        $job = Job::findOne($id);

        if ($job->isUserCanSuspend()) {
            $job->status = 'pending';
            $job->save();
        }

        return $this->redirect(['view', 'id' => $job->id]);
    }

    public function actionToWork($id)
    {
        $job = Job::findOne($id);

        if ($job->performer_id == Yii::$app->user->identity->getId() || $job->creator_id == Yii::$app->user->identity->getId()) {
            $job->status = 'on-the-job';
            $job->save();
        }

        return $this->redirect(['view', 'id' => $job->id]);
    }

    public function actionDone($id)
    {
        $job = Job::findOne($id);

        if ($job->isUserCanDone()) {
            $job->status  = 'done';
            $job->done_at = date("Y-m-d H:i:s");
            $job->save();
        }

        return $this->redirect(['view', 'id' => $job->id]);
    }

    public function actionClose($id)
    {
        $job = Job::findOne($id);

        if (Yii::$app->user->can('closeJob')) {
            $job->status = 'closed';
            $job->save();
        }

        return $this->redirect(['view', 'id' => $job->id]);
    }

    public function actionPrint($id)
    {
        $job = Job::find()->where(['id' => $id])->with(['client', 'vehicle.model.brand', 'tasks'])->one();

        return $this->renderPartial('print', ['job' => $job]);
    }

    public function actionPayForJobForm()
    {
        $searchModel  = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pay-for-job-form', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPay()
    {
        $jobs      = Yii::$app->request->post('Job');

        if (is_null($jobs)) {
            throw new NotFoundHttpException();
        }

        $payJobIDs = [];
        $toPay     = 0;

        foreach ($jobs as $jobID => $jobData) {
            if ($jobData['pay'] == '1') {
                $payJobIDs[] = $jobID;
            }
        }

        $jobs = Job::findAll($payJobIDs);

        foreach ($jobs as $job) {
            /* @var $job Job */
            $job->pay = 1;
            $job->save();
            $toPay += $job->getPerformerPrice();
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $jobs,
        ]);

        return $this->render('pay-result', [
            'dataProvider' => $dataProvider,
            'toPay'        => $toPay,
        ]);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
