<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \yii\helpers\Json;

/**
 * This is the model class for table "admin_script_assign".
 *
 * @property string $id
 * @property string $assign_type
 * @property string $page_id
 * @property string $script_type
 * @property integer $script_id
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class ScriptAssign extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_script_assign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['assign_type', 'script_type', 'script_id'], 'required'],
            [['assign_type', 'script_type'], 'string'],
            [['page_id', 'script_id'], 'integer']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'assign_type' => Yii::t('app', 'Assign Type'),
            'page_id' => Yii::t('app', 'Page ID'),
            'script_type' => Yii::t('app', 'Script Type'),
            'script_id' => Yii::t('app', 'Script'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return array options for creating javascript or css
     */
    public function getScriptTypeOptions()
    {
        return [
            'JS'=>'Javascript',
            'CSS'=>'CSS'
        ];
    }

    /**
     * @return string
     */
    public function getScriptTypeText()
    {
        return $this->script_type === 'JS' ? 'Javascript' : 'Css';
    }

    /**
     * @return string content of the script based on script_id
     */
    public function getScriptContent()
    {
        return Script::findOne($this->script_id)->content;
    }

    /**
     * @return string name of the script based on script_id
     */
    public function getScriptName()
    {
        return Script::findOne($this->script_id)->name;
    }

    /**
     * used in create and update actions
     * @param $stype string script type
     * @return string
     */
    public function getScriptOptions($stype)
    {
        $type = '';
        $prompt = '';
        switch($stype){
            case 'JS':
                $type = 'JS';
                $prompt = 'Javascript';
                break;
            case 'CSS':
                $type = 'CSS';
                $prompt = 'Style Sheet';
                break;
        }
        $list = Script::find()
            ->where(['deleted'=>Script::DELETED_NO, 'status'=>Script::STATUS_ACTIVE, 'type'=>$type])
            ->asArray()
            ->all();

        $listOptions = ArrayHelper::map($list, 'id', 'name');
        $dropList = Html::activeDropDownList($this, 'script_id', $listOptions, ['prompt'=>'Select '.$prompt ]);
        return Json::encode($dropList);
    }
}
