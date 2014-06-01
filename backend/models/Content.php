<?php

namespace backend\models;

use Yii;
use backend\components\AdminActiveRecord;
use backend\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "admin_content".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Content extends AdminActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_content';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),
            [
                ['name', 'required'],
                ['name', 'string', 'min'=>5, 'max'=>255],

                ['content', 'required'],
                ['content', 'string'],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getContentOptions()
    {
        $list = $this->find()
            ->where(['deleted'=>self::DELETED_NO, 'status'=>self::STATUS_ACTIVE])
            ->asArray()
            ->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
