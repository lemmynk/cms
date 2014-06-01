<?php

namespace backend\models;

use backend\helpers\HelpFunctions;
use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_page".
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property integer $tpl_id
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Template $template
 */
class Page extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['tpl_id', 'url', 'title', 'name'], 'required'],
            [['tpl_id'], 'integer'],
            [['keywords', 'description'], 'string'],
            [['name', 'url'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 255]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'tpl_id' => Yii::t('app', 'Template'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'tpl_id']);
    }

    public static function getPageByUrl($url)
    {
        return self::find()
            ->where(['deleted'=>self::DELETED_NO, 'status'=>self::STATUS_ACTIVE, 'url'=>$url])
            ->one();
    }
}
