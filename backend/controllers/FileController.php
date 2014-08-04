<?php

namespace backend\controllers;

use backend\models\FileCategory;
use Yii;
use backend\models\File;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AdminAccessRule;
use yii\helpers\Json;
use backend\helpers\HelpFunctions;
use yii\web\UploadedFile;
use yii\web\HttpException;
/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
{
    public $layout = '@backend/views/file-category/layout.php';

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
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => File::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->request->getIsAjax()){
            echo $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
            Yii::$app->end();
        }
        else
            throw new HttpException(500, "Action not allowed");
    }

    /**
     * Creates a new File model.
     * @param $cid integer id of the file category
     * @return mixed
     */
    public function actionCreate($cid)
    {
        $model = new File;

        $cat = FileCategory::findOne($cid);
        if($cat){
            if(Yii::$app->request->getIsAjax() && isset($_POST['File']) && !isset($_FILES['File'])){
                $model->attributes = $_POST['File'];
                if(!$model->validate(['name','ext'])){
                    echo Json::encode(['error'=>$model->getErrors()]);
                    Yii::$app->end();
                }
                else{
                    echo Json::encode(array('error'=>''));
                    Yii::$app->end();
                }
            }
            if(Yii::$app->request->getIsAjax() && isset($_POST['File']) && isset($_FILES['File'])){
                $file = UploadedFile::getInstance($model, 'file');
                if(is_object($file) && get_class($file ) === UploadedFile::className() && !$file->hasError){
                    $model->file = $file;
                    $tmp = explode(".", $file->name);
                    if(isset($_POST['File']['name']))
                        $model->name = $_POST['File']['name'];
                    else
                        $model->name = current($tmp);
                    $model->ext = strtolower($file->extension);
                    $model->type = $file->type;
                    $model->category_id = $cid;
                    $model->status = 1;
                    if($model->save()){
                        $model->file->saveAs($model->getSavePath());
                        Yii::$app->end();
                    }
                    else{
                        echo Json::encode(array("error"=> $model->getErrors()));
                        Yii::$app->end();
                    }
                }
                else{
                    throw new HttpException(500, "Could not upload file");
                }
            }

        }
        else{
            throw new NotFoundHttpException('The requested category does not exist.');
        }

        return $this->render('create', [
            'model' => $model,
            'cid'=>$cid
        ]);
    }

    /**
     * Updates an existing File model.
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
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $path = $model->getSavePath();
        if(is_file($path)){
            unlink($path);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
