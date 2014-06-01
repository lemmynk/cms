<?php

namespace backend\controllers;

use Yii;
use backend\models\Template;
use backend\models\TemplateSector;
use backend\helpers\HelpFunctions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AdminAccessRule;

/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
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
     * Lists all Template models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Template::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Template model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TemplateSector::find()->where([
                'deleted'=>TemplateSector::DELETED_NO,
                'tpl_id'=>$id
            ]),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Creates a new Template model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Template;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*$sectors = $model->getTemplateSectors();
            foreach($sectors as $sec){
                list($type, $filename) = $sec;
                //HelpFunctions::echoArray(array($type, $filename));
                $sector = new TemplateSector;
                $sector->name = ucfirst($filename);
                $sector->filename = $filename;
                $sector->tpl_id = $model->id;
                $sector->sector_type = $type;
                $sector->save();
            }/**/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Template model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //\backend\helpers\HelpFunctions::echoArray(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*$sectors = $model->getTemplateSectors();
            foreach($sectors as $sec){
                list($type, $filename) = $sec;
                //HelpFunctions::echoArray(array($type, $filename));
                $sector = new TemplateSector;
                $sector->name = ucfirst($filename);
                $sector->filename = $filename;
                $sector->tpl_id = $model->id;
                $sector->sector_type = $type;
                $sector->save();
            }/**/
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Template model.
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
     * Finds the Template model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Template the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
