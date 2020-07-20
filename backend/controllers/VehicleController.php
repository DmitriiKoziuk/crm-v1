<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\Vehicle;
use backend\models\VehicleSearch;
use backend\repositories\VehicleModelRepository;

/**
 * VehicleController implements the CRUD actions for Vehicle model.
 */
class VehicleController extends Controller
{
    private $vehicleModelRepository;

    public function __construct(
        $id,
        $module,
        VehicleModelRepository $vehicleModelRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->vehicleModelRepository = $vehicleModelRepository;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vehicle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehicleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehicle model.
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
     * Creates a new Vehicle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vehicle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vehicle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vehicle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetList($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $out = ['results' => ['id' => '', 'frame_number' => '']];

        if (! is_null($q)) {
            $vehicles = Vehicle::find()
                ->select(['id' => 'frame_number', 'frame_number'])
                ->where(['like', 'frame_number', $q])
                ->indexBy('id')
                ->limit(10)
                ->asArray()
                ->all();

            if (count($vehicles) == 0) {
                $vehicles[] = ['id' => $q, 'frame_number' => $q];
            }

            $out['results'] = array_values($vehicles);
        } elseif (! is_null($id)) {

        }

        return $out;
    }

    public function actionBrandVehicles()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $post = Yii::$app->request->post();
            if (empty($post['depdrop_all_params']['vehicleBrandId'])) {
                throw new \Exception();
            }
            $brandId = (int) $post['depdrop_all_params']['vehicleBrandId'];
            $vehicleModels = $this->vehicleModelRepository->getModels($brandId);
            $response = [
                'output' => [],
                'selected' => '',
            ];
            foreach ($vehicleModels as $vehicleModel) {
                $response['output'][] = [
                    'id' => $vehicleModel->id,
                    'name' => $vehicleModel->name,
                ];
            }
            return $response;
        } catch (\Throwable $e) {
            Yii::error($e);
            throw new ServerErrorHttpException();
        }
    }

    /**
     * Finds the Vehicle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehicle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehicle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
