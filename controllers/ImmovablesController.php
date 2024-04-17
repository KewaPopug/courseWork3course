<?php

namespace app\controllers;

use app\models\Cashbox;
use app\models\Clients;
use app\models\Immovables;
use app\models\ImmovablesOperations;
use app\models\ImmovablesSearch;
use app\models\ImmovablesTypes;
use app\models\Personal;
use app\models\Regions;
use mdm\admin\components\AccessControl;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImmovablesController implements the CRUD actions for Immovables model.
 */
class ImmovablesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                ],
            ]
        );
    }

    /**
     * Lists all Immovables models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ImmovablesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Immovables model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Immovables model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Immovables();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data' => [
                'clients' => ArrayHelper::map(Clients::find()->all(), 'id', 'name'),
                'regions' => ArrayHelper::map(Regions::find()->all(), 'id', 'name'),
                'immovables_types' => ArrayHelper::map(ImmovablesTypes::find()->all(), 'id', 'name'),
            ]
        ]);
    }

    /**
     * Updates an existing Immovables model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => [
                'clients' => ArrayHelper::map(Clients::find()->all(), 'id', 'name'),
                'regions' => ArrayHelper::map(Regions::find()->all(), 'id', 'name'),
                'immovables_types' => ArrayHelper::map(ImmovablesTypes::find()->all(), 'id', 'name'),
            ]
        ]);
    }

    /**
     * Deletes an existing Immovables model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * @return string
     */
    public function actionImmovablesByAddress(): string
    {
        $model = new Immovables();
        $alertMessage = '';

        if ($this->request->isPost) {
            $data = $model->getImmovablesByAddress(Yii::$app->request->post('address'));

            if ($data != null)
                return $this->render('immovables-by-address/index', ['data' => $data]);
            $alertMessage = 'По этому пользователю нет данных или неправильно переданны данные';
        }

        return $this->render('immovables-by-address/search_address', [
            'immovablesOperations' => ArrayHelper::map(ImmovablesOperations::find()->all(), 'id', 'name'),
            'alertMessage' => $alertMessage,
        ]);
    }

    /**
     * @return string
     */
    public function actionImmovablesGroupByRegion(): string
    {
        $model = new Immovables();
        $data = $model->getImmovablesGroupByRegion();

        return $this->render('immovables-group-by-region/index', ['data' => $data]);
    }

    /**
     * @return string
     */
    public function actionImmovablesByStatus(): string
    {
        $model = new Immovables();
        $data = $model->getImmovablesByStatus();

        return $this->render('immovables-by-status/index', ['data' => $data]);
    }


    /**
     * Finds the Immovables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Immovables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Immovables::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
