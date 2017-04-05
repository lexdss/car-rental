<?php

namespace app\models\forms;

use app\models\User;
use Yii;

class LoginForm extends \yii\base\Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
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
     * Validate user email and password
     *
     * @param $attribute
     * @param $params
     */
    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !Yii::$app->getSecurity()->validatePassword($this->{$attribute}, $user->{$attribute}))
                $this->addError($attribute, 'Не верный пользователь или пароль');
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}