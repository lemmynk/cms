<?php
/**
 * Created by miller 
 * Date: 5/9/14
 * Time: 2:30 PM
 */

namespace backend\components;

use Yii;
use backend\models\User;

class AdminActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const DELETED_NO = 0;
    const DELETED_YES = 1;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'userstamp' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
                'value'=>function(){
                    return Yii::$app->user->id;
                }
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],

            ['deleted', 'default', 'value' => self::DELETED_NO],
            ['deleted', 'in', 'range' => [self::DELETED_NO, self::DELETED_YES]],
        ];
    }

    /**
     * @param int user status
     * @return string active/inactive
     */
    public function getStatusText($status=null)
    {
        return $this->status === self::STATUS_ACTIVE ? 'Active' : 'Inactive';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditor()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}