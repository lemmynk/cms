<?php

namespace backend\controllers;

use Yii;
use backend\models\ScriptAssign;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AdminAccessRule;

/**
 * ScriptAssignController implements the CRUD actions for ScriptAssign model.
 */
class ScriptAssignController extends Controller
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
     * Lists all ScriptAssign models.
     * @param string $type P=>page or T=>template
     * @param int $pid id of page or template
     * @return mixed
     */
    public function actionIndex($type, $pid)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ScriptAssign::find()
                ->where(['deleted'=>ScriptAssign::DELETED_NO, 'assign_type'=>$type, 'page_id'=>(int)$pid]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'assignType'=>$type,
            'pageId'=>$pid
        ]);
    }

    /**
     * Displays a single ScriptAssign model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'pageId'=>$model->page_id,
            'assignType'=>$model->assign_type
        ]);
    }

    /**
     * Creates a new ScriptAssign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $type P=>page or T=>template
     * @param int $pid id of page or template
     * @return mixed
     */
    public function actionCreate($type, $pid)
    {
        $model = new ScriptAssign;

        if(Yii::$app->request->isAjax && isset($_POST['stype'])){
            echo $model->getScriptOptions($_POST['stype']);
            Yii::$app->end();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'assignType'=>$type,
                'pageId'=>$pid
            ]);
        }
    }

    /**
     * Updates an existing ScriptAssign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing ScriptAssign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ScriptAssign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ScriptAssign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScriptAssign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
