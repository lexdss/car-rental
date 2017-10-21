<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $role
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property integer $addDate
 * @property string $fullName
 *
 * @property Order[] $orders
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{user}}';
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
                    self::EVENT_BEFORE_INSERT => 'addDate'
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return ($this->role == self::ROLE_ADMIN) ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['userId' => 'id']);
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

    /**
     * @param string $password
     * @return string
     */
    public static function getPasswordHash($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * @param string $password
     */
    public function setNewPassword($password)
    {
        $this->password = self::getPasswordHash($password);
    }
}
