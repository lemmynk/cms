<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \yii\helpers\Json;

/**
 * This is the model class for table "admin_assign".
 *
 * @property string $id
 * @property string $lang_id
 * @property string $assign_type
 * @property string $page_id
 * @property string $content_type
 * @property integer $content_id
 * @property integer $sector_id
 * @property string $order_by
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property TemplateSector $sector
 */
class Assign extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_assign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['page_id','assign_type', 'content_type', 'content_id', 'sector_id'], 'required'],
            [['assign_type', 'content_type'], 'string'],
            [['page_id', 'content_id', 'sector_id', 'order_by'], 'integer'],
            [['lang_id'], 'string', 'max' => 2]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lang_id' => Yii::t('app', 'Language'),
            'assign_type' => Yii::t('app', 'Assign Type'),
            'page_id' => $this->assign_type == 'P' ? Yii::t('app', 'Page') : Yii::t('app', 'Template'),
            'content_type' => Yii::t('app', 'Content Type'),
            'content_id' => Yii::t('app', 'Content'),
            'sector_id' => Yii::t('app', 'Sector'),
            'order_by' => Yii::t('app', 'Order By'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return string proper label for content_id attribute
     */
    public function getLabelForContentId()
    {
        $ret = '';
        switch ($this->content_type){
            case 'C':
                $ret = 'Content';//Yii::t('app', 'Content');
                break;
            case 'W':
                $ret = Yii::t('app', 'Widget');
                break;
            case 'MW':
                $ret = Yii::t('app', 'Module Widget');
                break;
            /*default:
                $ret = Yii::t('app', 'Content');
                break;/**/
        }
        return $ret;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(TemplateSector::className(), ['id' => 'sector_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageOrTemplate()
    {
        $class = $this->assign_type === 'T' ? Template::className() : Page::className();
        return $this->hasOne($class, ['id' => 'page_id']);
    }
    /**
     * @return array
     */
    public function getContentTypeOptions()
    {
        return [
            'C'=>'Content',
            'W'=>'Widget'
        ];
    }

    /**
     * @return string
     */
    public function getContentTypeName()
    {
        $ret = '';
        switch($this->content_type){
            case 'C':
                $ret = 'Content';
                break;
            case 'W':
                $ret = 'Widget';
                break;
            case 'MW':
                $ret = 'Module Widget';
                break;
        }
        return $ret;
    }

    /**
     * used in create and update actions
     * @param $cType string content type
     * @return string
     */
    public function getContentOptions($cType)
    {
        $modelClass = null;
        $prompt = '';
        switch($cType){
            case 'C':
                $modelClass = Content::className();
                $prompt = 'Content';
                break;
        }
        $list = $modelClass::find()
            ->where(['deleted'=>$modelClass::DELETED_NO, 'status'=>$modelClass::STATUS_ACTIVE])
            ->asArray()
            ->all();

        $listOptions = ArrayHelper::map($list, 'id', 'name');
        $dropList = Html::activeDropDownList($this, 'content_id', $listOptions, ['prompt'=>'Select '.$prompt ]);
        return Json::encode($dropList);
    }

    /**
     * @return string
     */
    public function getContentName()
    {
        $ret = '';
        switch($this->content_type){
            case 'C':
                $ret = Content::findOne(['id'=>$this->content_id])->name;
                break;
            case 'W':
                $ret = 'Widget';
                break;
            case 'MW':
                $ret = 'Module Widget';
                break;
        }
        return $ret;
    }

    /**
     * @return string name of assign_type: Page or Template
     */
    public function getAssignType()
    {
        return $this->assign_type === 'T' ? 'Template' : 'Page';
    }
}
