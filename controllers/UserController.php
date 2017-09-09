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
                ->setSubject('Добро пожаловать на EasyRent')
                ->send();

            Yii::$app->session->setFlash('register', 'Вы успешно зарегистрированы, проверьте вашу почту');
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

        return $this->renderPartial('login', ['loginForm' => $model]);
    }

    /**
     * Logout action.
     * @return string
     * @throws ErrorException
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->logout()) {
            throw new ErrorException('Ошибка при попытке выхода');
        }

        return $this->renderPartial('login'); // TODO выход в админке
    }
}