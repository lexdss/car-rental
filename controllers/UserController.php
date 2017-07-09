<?php

namespace app\controllers;

use Symfony\Component\Yaml\Yaml;
use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\forms\UserRegisterForm;
use app\models\forms\LoginForm;

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'register'],
                'rules' => [
                    [
                        'actions' => ['register', 'login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => false,
                        'roles' => ['?'],
                        'denyCallback' => function() {
                            throw new NotFoundHttpException('Страница не найдена');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post']
                ]
            ]
        ];
    }

    /**
     * Register User
     * @return string
     */
    public function actionRegister()
    {
        $model = new UserRegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->register();

            $user = Yii::$app->user->identity;

            Yii::$app->mailer->compose('register', ['user' => $user])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($user->email)
                ->setSubject('Регистрация прошла успешно. Добро пожаловать')
                ->send();

            Yii::$app->session->setFlash('register', 'Вы успешно зарегистрированы');
        }

        return $this->render('register', ['model' => $model]);
    }

    /**
     * Login User
     * @return string
     * @throws ErrorException
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!Yii::$app->user->login($model->getUser())) {
                throw  new ErrorException('Ошибка при попытке входа');
            }
        }
        Yii::$app->mailer->compose()
            ->setFrom('jinnco@yandex.ru')
            ->setTo('lexdss@gmail.com')
            ->setSubject('Subj')
            ->setHtmlBody('<b>Aaaaaaaa</b> <i>Oooooo</i>')
            ->send();

        return $this->goHome();
    }

    /**
     * Logout action.
     * @return string
     * @throws ErrorException
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->logout())
            throw new ErrorException('Ошибка при попытке выхода');

        return $this->goHome();
    }
}