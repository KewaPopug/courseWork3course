<?php

namespace app\controllers;

use app\models\FullViewTableWithRelationsImmovables;
use app\models\FullViewTableWithRelationsImmovablesSearch;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class FullViewTableWithRelationsImmovablesController extends Controller
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
     * Lists all FullViewTableWithRelationsImmovables models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FullViewTableWithRelationsImmovablesSearch();
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
     * Finds the Immovables model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FullViewTableWithRelationsImmovables the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): FullViewTableWithRelationsImmovables
    {
        if (($model = FullViewTableWithRelationsImmovables::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}