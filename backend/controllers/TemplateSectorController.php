<?php

namespace backend\controllers;

use Yii;
use backend\models\TemplateSector;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AdminAccessRule;
use backend\helpers\HelpFunctions;

/**
 * TemplateSectorController implements the CRUD actions for TemplateSector model.
 */
class TemplateSectorController extends Controller
{
    public $layout = 'column';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AdminAccessRule::className()
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['editor', 'admin'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all TemplateSector models.
     * @param integer $id id of template
     * @return mixed
     */
    public function actionIndex($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TemplateSector::find()
                ->where([
                    'deleted'=>TemplateSector::DELETED_NO,
                    'tpl_id'=>$id
                ])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'tplId'=>$id
        ]);
    }

    /**
     * Displays a single TemplateSector model.
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
     * Creates a new TemplateSector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $id of template
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new TemplateSector;
        //HelpFunctions::echoArray(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tplId'=>$id,
            ]);
        }
    }

    /**
     * Updates an existing TemplateSector model.
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
                'tplId'=>$model->tpl_id,
            ]);
        }
    }

    /**
     * Deletes an existing TemplateSector model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tplId = $model->tpl_id;
        $model->delete();

        return $this->redirect(['index', 'id'=>$tplId]);
    }

    /**
     * Finds the TemplateSector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TemplateSector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TemplateSector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
