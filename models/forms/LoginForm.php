<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'trim'],
            ['email', 'email'],
            ['password', 'validateUser']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль'
        ];
    }

    /**
     * Validate user email and password for rules
     *
     * @param $attribute
     */
    public function validateUser($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !Yii::$app->getSecurity()->validatePassword($this->{$attribute}, $user->{$attribute})) {
                $this->addError($attribute, 'Не верный пользователь или пароль');
            }
        }
    }

    /**
     * @return \app\models\User
     */
    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}