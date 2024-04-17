<?php

namespace app\controllers;

use app\models\Cashbox;
use app\models\CashboxSearch;
use app\models\Clients;
use app\models\Contracts;
use app\models\Personal;
use mdm\admin\components\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CashboxController implements the CRUD actions for Cashbox model.
 */
class CashboxController extends Controller
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
     * Lists all Cashbox models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CashboxSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cashbox model.
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
     * Creates a new Cashbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Cashbox();

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
                'personals' => ArrayHelper::map(Personal::find()->all(), 'id', 'name'),
                'contracts' => ArrayHelper::map(Contracts::find()->orderBy('number')->all(), 'number', 'number'),
            ]
        ]);
    }

    /**
     * Updates an existing Cashbox model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
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
                'personals' => ArrayHelper::map(Personal::find()->all(), 'id', 'name'),
                'contracts' => ArrayHelper::map(Contracts::find()->orderBy('number')->all(), 'number', 'number'),
            ]
        ]);
    }

    /**
     * Deletes an existing Cashbox model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSummaryEnteredByPersonal(): string
    {
        $model = new Cashbox();

        $dataProvider = $model->getSummaryEnteredByPersonal();

        return $this->render('summary-entered-by-personal/index', [
            'data' => $dataProvider
        ]);
    }


    /**
     * Finds the Cashbox model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cashbox the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cashbox::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
