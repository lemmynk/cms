<?php

namespace backend\models;

use Yii;
use backend\models\User;
use backend\models\File;
use yii\helpers\ArrayHelper;
use backend\helpers\HelpFunctions;
use backend\components\AdminActiveRecord;

/**
 * This is the model class for table "admin_file_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property File[] $Files
 */
class FileCategory extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_file_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['name', 'required'],
            ['name', 'string', 'min'=>2, 'max'=>255]
        ]);
    }

    public function beforeValidate()
    {
        $this->filename = HelpFunctions::parseForSEO($this->name);
        return parent::beforeValidate();
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
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['category_id' => 'id']);
    }
}
