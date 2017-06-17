<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $role
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property integer $add_date
 *
 * @property Order[] $orders
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'add_date'
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->surname . ' ' . $this->patronymic;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * @param int|string $id
     * @return static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param mixed $token
     * @param mixed $type
     * @return void
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken не реализован');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @throws NotSupportedException
     */
    public function getAuthKey()
    {
        throw new NotSupportedException('getAuthKey не реализован');
    }

    /**
     * @param string $authKey
     * @return void
     * @throws NotSupportedException
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException('validateAuthKey не реализован');
    }
}
