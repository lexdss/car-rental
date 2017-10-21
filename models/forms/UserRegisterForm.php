<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\base\ErrorException;
use app\models\User;

class UserRegisterForm extends Model
{
    const SCENARIO_SET_NEW_PASSWORD = 'set_new_password';

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => User::ROLE_USER], // Default - user
            [['name', 'surname', 'email', 'phone', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'phone', 'password', 'password_repeat'], 'trim'],
            [['name', 'surname', 'patronymic', 'email', 'phone'], 'string', 'max' => 25],
            [['password', 'password_repeat'], 'string', 'min' => 5, 'max' => 255],
            ['password', 'compare'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'except' => self::SCENARIO_SET_NEW_PASSWORD],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_NEW_PASSWORD] = ['password', 'password_repeat', 'email'];

        return $scenarios;
    }

    /**
     * Register User
     * @return User
     * @throws ErrorException
     */
    public function register()
    {
        $user = new User();

        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->patronymic = $this->patronymic;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role = $this->role;
        $user->password = User::getPasswordHash($this->password);

        if ($user->save(false) && Yii::$app->user->login($user)) {
            return $user;
        } else {
            throw new ErrorException('Ошибка в БД');
        }
    }
}