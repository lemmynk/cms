<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use yii\helpers\ArrayHelper;
use backend\helpers\HelpFunctions;

/**
 * This is the model class for table "admin_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $template_form
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property Page[] $Pages
 * @property TemplateSector[] $Sectors
 */
class Template extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['template_form'], 'required'],
            [['template_form'], 'string'],

            ['name', 'required'],
            [['name'], 'string', 'max' => 100]
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
            'template_form' => Yii::t('app', 'Template Form'),
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
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['tpl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(TemplateSector::className(), ['tpl_id' => 'id'])
            ->where(['deleted'=>TemplateSector::DELETED_NO, 'status'=>TemplateSector::STATUS_ACTIVE]);
    }

    /**
     * @return array id=>name
     */
    public static function getTemplateOptions()
    {
        $list = self::find()
            //->select('id', 'name')
            ->where(['deleted'=>self::DELETED_NO, 'status'=>self::STATUS_ACTIVE])
            ->asArray()
            ->all();
        //HelpFunctions::echoArray($list);
        //HelpFunctions::echoArray(ArrayHelper::map($list, 'id', 'name'));
        return ArrayHelper::map($list, 'id', 'name');
    }
    /**
     * @return array template sectors in form type=>filename
     * from template_form in order to create them. Function is mainly used in
     * {@link TemplateController::create} and {@link TemplateController::update}
     */
    public function getTemplateSectors()
    {
        $ret = array();
        $form = $this->template_form;
        $tmp = strip_tags($form);
        $sectors = preg_split("/[\s{}]+/", $tmp);
        array_shift($sectors);
        array_pop($sectors);
        foreach($sectors as $sector){
            $t = array();
            $temp = explode("%", $sector);
            $v = current($temp);
            $k = end($temp);
            $t[] = $k;
            $t[] = $v;
            $ret[] = $t;
            unset($t);
        }
        //HelpFunctions::echoArray($ret);
        return $ret;
    }
}
