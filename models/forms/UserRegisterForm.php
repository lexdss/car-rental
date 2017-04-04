<?php

namespace app\models\forms;

use Yii;
use app\models\User;

class UserRegisterForm extends \yii\base\Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;
    public $role;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }

    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 'user'],
            [['name', 'surname', 'email', 'phone', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'phone'], 'string', 'max' => 25],
            [['password', 'password_repeat'], 'string', 'min' => 5, 'max' => 255],
            ['password', 'compare'],
            [['email'], 'unique', 'targetClass' => 'app\models\User'],
        ];
    }

    public function register()
    {
        $user = new User();

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->patronymic = $this->patronymic;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role = $this->role;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);

        return $user->save(false);
    }
}