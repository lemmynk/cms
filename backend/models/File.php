<?php

namespace backend\models;

use Yii;
use backend\models\User;
use backend\models\FileCategory;

/**
 * This is the model class for table "admin_file".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $filename
 * @property string $ext
 * @property string $type
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property FileCategory $category
 */
class File extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            ['name', 'unique'],
            [['name', 'filename', 'type'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 10],
            ['file', 'file', 'maxFiles'=>100],
            ['file', 'file', 'types'=>['jpg', 'jpeg', 'gif', 'png', 'tiff', 'pdf', 'doc', 'docx', 'zip', 'ppt', 'pptx', 'xls', 'xlsx']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'category_id' => Yii::t('app', 'Category'),
            'filename' => Yii::t('app', 'Filename'),
            'ext' => Yii::t('app', 'Extension'),
            'type' => Yii::t('app', 'Type'),
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
    public function getCategory()
    {
        return $this->hasOne(FileCategory::className(), ['id' => 'category_id']);
    }
}
