<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;
use backend\helpers\HelpFunctions;

/**
 * This is the model class for table "admin_script".
 *
 * @property integer $id
 * @property string type
 * @property integer $script_type
 * @property string $name
 * @property string $filename
 * @property string $url
 * @property string $content
 * @property integer $depend
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Script extends AdminActiveRecord
{
    const INLINE_SCRIPT = 1;
    const URL_SCRIPT = 0;

    const DEPEND_YES = 1;
    const DEPEND_NO = 0;

    public function beforeValidate()
    {
        $this->filename = HelpFunctions::parseForSEO($this->name);
        return parent::beforeValidate();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_script';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['type', 'required'],
            ['type', 'default', 'value'=>'JS'],
            ['type', 'in', 'range'=>['JS', 'CSS']],
            [['content'], 'string'],
            [['name'], 'required'],
            ['url', 'url'],
            [['name', 'filename'], 'string', 'max' => 255],
            ['script_type', 'required'],
            ['script_type', 'default', 'value' => self::INLINE_SCRIPT],
            ['script_type', 'in', 'range' => [self::INLINE_SCRIPT, self::URL_SCRIPT]],
            ['depend', 'default', 'value' => self::DEPEND_NO],
            ['depend', 'in', 'range' => [self::DEPEND_NO, self::DEPEND_YES]],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'script_type' => Yii::t('app', 'Script Type'),
            'name' => Yii::t('app', 'Name'),
            'filename' => Yii::t('app', 'Filename'),
            'url' => Yii::t('app', 'Url'),
            'content' => Yii::t('app', 'Content'),
            'depend' => Yii::t('app', 'jQuery Depended'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return array options for creating javascript or css
     */
    public function getTypeOptions()
    {
        return [
            'JS'=>'Javascript',
            'CSS'=>'CSS'
        ];
    }

    /**
     * @return string
     */
    public function getTypeText()
    {
        return $this->type === 'JS' ? 'Javascript' : 'CSS';
    }

    /**
     * @return array
     */
    public function getScriptTypeOptions()
    {
        return [
            self::INLINE_SCRIPT => 'Inline',
            self::URL_SCRIPT => 'Url'
        ];
    }

    /**
     * @return string
     */
    public function getScriptTypeText()
    {
        return $this->script_type === self::INLINE_SCRIPT ? 'Inline' : 'Url';
    }

    /**
     * @return string
     */
    public function getDependText()
    {
        return $this->depend === self::DEPEND_YES ? 'Yes' : 'No';
    }
}
