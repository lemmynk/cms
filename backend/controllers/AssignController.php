<?php

namespace backend\controllers;

use Yii;
use backend\models\Assign;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AdminAccessRule;
use backend\helpers\HelpFunctions;

/**
 * AssignController implements the CRUD actions for Assign model.
 */
class AssignController extends Controller
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
     * Lists all Assign models.
     * @param string $type P=>page or T=>template
     * @param int $pid id of page or template
     * @return mixed
     */
    public function actionIndex($type, $pid)
    {
        //HelpFunctions::echoArray(array('id'=>$id, 'type'=>$type));
        $dataProvider = new ActiveDataProvider([
            'query' => Assign::find()
                ->where(['deleted'=>Assign::DELETED_NO, 'assign_type'=>$type, 'page_id'=>(int)$pid])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'assignType'=>$type,
            'pageId'=>$pid
        ]);
    }

    /**
     * Displays a single Assign model.
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
     * Creates a new Assign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param string $type P=>page or T=>template
     * @param int $pid id of page or template
     * @return mixed
     */
    public function actionCreate($type, $pid)
    {
        $model = new Assign;

        if(Yii::$app->request->isAjax){
            echo $model->getContentOptions($_POST['cid']);
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
     * Updates an existing Assign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax){
            echo $model->getContentOptions($_POST['cid']);
            Yii::$app->end();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'pageId'=>$model->page_id,
                'assignType'=>$model->assign_type
            ]);
        }
    }

    /**
     * Deletes an existing Assign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $type = $model->assign_type;
        $pid = $model->page_id;
        $model->delete();

        return $this->redirect(['index', 'type'=>$type, 'pid'=>$pid]);
    }

    /**
     * Finds the Assign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Assign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
