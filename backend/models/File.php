<?php

namespace backend\models;

use backend\helpers\HelpFunctions;
use Yii;
use backend\models\User;
use backend\models\FileCategory;
use backend\components\AdminActiveRecord;

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
class File extends AdminActiveRecord
{
    /**
     * @var object file property
     */
    public $file;
    /**
     * @var array allowed types of file extension
     * Used for validating extensions before files are uploaded
     */
    public $allowedTypes = ['jpg', 'jpeg', 'gif', 'png', 'tiff', 'txt', 'doc', 'docx', 'ppt',' pptx', 'xls', 'xlsx', 'pdf', 'flv', 'mpeg', 'mov', 'mp4', 'wmv', 'mp3', 'wma','wav', 'zip'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_file';
    }

    public function beforeValidate()
    {
        $this->filename = HelpFunctions::parseForSEO($this->name);
        return parent::beforeValidate();
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
            ['ext', 'validateFileType'],
            ['file', 'file', 'types'=>['jpg', 'jpeg', 'gif', 'png', 'tiff', 'txt', 'doc', 'docx', 'ppt',' pptx', 'xls', 'xlsx', 'pdf', 'flv', 'mpeg', 'mov', 'mp4', 'wmv', 'mp3', 'wma','wav', 'zip']]
        ];
    }

    /**
     * validates just extension
     */
    public function validateFileType($attr, $params)
    {
        if(!in_array($this->ext, $this->allowedTypes)){
            $this->addError($attr, 'Only types with these extensions are allowed:
            jpg, jpeg, gif, png, tiff, txt, doc, docx, ppt, pptx, xls, xlsx, pdf, flv, mpeg, mov, mp4, wmv, mp3, wma, wav, zip');
        }
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

    /**
     * @return string path for storing files
     */
    public function getSavePath()
    {
        return 'uploads/' . $this->getFileSaveName();
    }

    public function getFileUrl()
    {
        return Yii::$app->request->getBaseUrl(). '/uploads/' . $this->getFileSaveName();
    }

    /**
     * @return string
     */
    protected function getFileSaveName()
    {
        return $this->category_id . '_' . $this->filename . '.' . $this->ext;
    }
}
