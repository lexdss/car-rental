<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class RecoveryPassword
 * @package app\models
 *
 * @property integer $id
 * @property integer $userId
 * @property string $userHash
 *
 * @property User $user
 */
class RecoveryPassword extends ActiveRecord
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => '\app\models\User',
                'targetAttribute' => 'email',
                'message' => 'Нет пользователя с таким e-mail'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{recovery_password}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}