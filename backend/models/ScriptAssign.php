<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;

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
}
