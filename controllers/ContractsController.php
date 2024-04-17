<?php

namespace app\controllers;

use app\models\Clients;
use app\models\Contracts;
use app\models\ContractsSearch;
use app\models\Immovables;
use app\models\ImmovablesOperations;
use app\models\Personal;
use app\models\User;
use mdm\admin\components\AccessControl;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ContractsController implements the CRUD actions for Contracts model.
 */
class ContractsController extends Controller
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
     * Lists all Contracts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContractsSearch();
//        var_dump($searchModel);die();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contracts model.
     * @param int $number Number
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($number)
    {
        return $this->render('view', [
            'model' => $this->findModel($number),
        ]);
    }

    /**
     * Creates a new Contracts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Contracts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'number' => $model->number]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data' => [
                'clients' => ArrayHelper::map(Clients::find()->all(), 'id', 'name'),
                'personals' => ArrayHelper::map(Personal::find()->all(), 'id', 'name'),
                'immovables' => ArrayHelper::map(Immovables::find()->all(), 'id', 'address'),
                'immovables_operations' => ArrayHelper::map(ImmovablesOperations::find()->all(), 'id', 'name'),
            ]
        ]);
    }

    /**
     * Updates an existing Contracts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $number Number
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($number)
    {
        $model = $this->findModel($number);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'number' => $model->number]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => [
                'clients' => ArrayHelper::map(Clients::find()->all(), 'id', 'name'),
                'personals' => ArrayHelper::map(Personal::find()->all(), 'id', 'name'),
                'immovables' => ArrayHelper::map(Immovables::find()->all(), 'id', 'address'),
                'immovables_operations' => ArrayHelper::map(ImmovablesOperations::find()->all(), 'id', 'name'),
            ]
        ]);
    }

    /**
     * Deletes an existing Contracts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $number Number
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($number)
    {
        $this->findModel($number)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionContractByPersonal(): string
    {
        $model = new Contracts();
        $alertMessage = '';

        if ($this->request->isPost) {
            $data = $model->procedureContractByPersonal((int)Yii::$app->request->post('personal_id'));

            if ($data != null)
                return $this->render('contract-by-personal/index', ['data' => $data]);
            $alertMessage = 'По этому пользователю нет данных или неправильно переданны данные';
        }

        return $this->render('contract-by-personal/change_personal', [
            'personals' => ArrayHelper::map(Personal::find()->all(), 'id', 'name'),
            'alertMessage' => $alertMessage,
        ]);
    }

    /**
     * @return string
     */
    public function actionGeneralSumByImmovablesOperation(): string
    {
        $model = new Contracts();
        $alertMessage = '';

        if ($this->request->isPost) {
            $data = $model->procedureGeneralSumByImmovablesOperation((int)Yii::$app->request->post('immovables_operation_id'));

            if ($data != null)
                return $this->render('general-sum-by-immovables-operation/index', ['data' => $data]);
            $alertMessage = 'По этому пользователю нет данных или неправильно переданны данные';
        }

        return $this->render('general-sum-by-immovables-operation/change_personal', [
            'immovablesOperations' => ArrayHelper::map(ImmovablesOperations::find()->all(), 'id', 'name'),
            'alertMessage' => $alertMessage,
        ]);
    }

    /**
     * @return string
     */
    public function actionClientByImmovablesOperations(): string
    {
        $model = new Contracts();
        $alertMessage = '';

        if ($this->request->isPost) {
            $data = $model->getClientByImmovablesOperations((int)Yii::$app->request->post('immovables_operation_id'));

            if ($data != null)
                return $this->render('client-by-immovables-operation/index', ['data' => $data]);
            $alertMessage = 'По этому пользователю нет данных или неправильно переданны данные';
        }

        return $this->render('client-by-immovables-operation/change_personal', [
            'immovablesOperations' => ArrayHelper::map(ImmovablesOperations::find()->all(), 'id', 'name'),
            'alertMessage' => $alertMessage,
        ]);
    }

    /**
     * Finds the Contracts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $number Number
     * @return Contracts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($number)
    {
        if (($model = Contracts::findOne(['number' => $number])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
