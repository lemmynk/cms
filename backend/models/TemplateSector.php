<?php

namespace backend\models;

use backend\helpers\HelpFunctions;
use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_template_sector".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $tpl_id
 * @property string $sector_type
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Assign[] $assigns
 * @property Template $template
 */
class TemplateSector extends AdminActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_template_sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'filename', 'tpl_id'], 'required'],
            [['tpl_id'], 'integer'],
            [['sector_type'], 'string'],
            ['sector_type', 'default', 'value'=>'T'],
            [['name', 'filename'], 'string', 'max' => 100]
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
            'filename' => Yii::t('app', 'Filename'),
            'tpl_id' => Yii::t('app', 'Template'),
            'sector_type' => Yii::t('app', 'Sector Type'),
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
    public function getAssigns($tplId, $pid)
    {
        $id = $this->sector_type == 'T' ? $tplId : $pid;
        return $this->hasMany(Assign::className(), ['sector_id' => 'id'])
            ->where(['deleted'=>Assign::DELETED_NO, 'status'=>Assign::STATUS_ACTIVE, 'page_id'=>$id])
            ->orderBy('order_by');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'tpl_id']);
    }

    /**
     * @return mixed template name
     */
    public function getTemplateName()
    {
        return $this->getTemplate()->one()->name;
    }

    /**
     * @return array
     */
    public function getSectorTypeOptions()
    {
        return ['T'=>'Template', 'P'=>'Page'];
    }

    /**
     * @return string
     */
    public function getSectorTypeName()
    {
        return $this->sector_type === 'T' ? 'Template' : 'Page';
    }

    /**
     * @param $secType string sector type P or T
     * @return array sectors
     */
    public static function getSectorsOptions($secType)
    {
        $list = self::find()
            ->where(['sector_type'=>$secType, 'deleted'=>self::DELETED_NO, 'status'=>self::STATUS_ACTIVE])
            ->asArray()
            ->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public function getSectorContent($tpl_id, $pid)
    {
        //HelpFunctions::echoArray(['template'=>$tpl_id, 'page'=>$pid]);
        $content = '';
        foreach($this->getAssigns($tpl_id, $pid)->all() as $assign){
            $content .= $assign->getContent()->one()->content . "\n";
        }
        return $content;
    }
}
