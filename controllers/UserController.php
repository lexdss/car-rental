<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\forms\UserRegisterForm;
use app\models\forms\LoginForm;
use app\models\RecoveryPassword;

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
                    'login' => ['post'],
                    'recovery-password' => ['post']
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

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_login', ['loginForm' => $model]);
        }

        return $this->goHome(); // If JS disabled
    }

    /**
     * Logout action.
     * @return string
     * @throws ErrorException
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Recovery user password
     * @return string
     * @throws ErrorException;
     */
    public function actionRecoveryPassword()
    {
        $recoveryPassword = new RecoveryPassword();

        if ($recoveryPassword->load(Yii::$app->request->post()) && $recoveryPassword->validate()) {
            $user = User::findOne(['email' => $recoveryPassword->email]);

            $recoveryPassword->userId = $user->id;
            $recoveryPassword->userHash = Yii::$app->security->generateRandomString();

            if (!$recoveryPassword->save(false)) {
                throw new ErrorException();
            }

            //TODO раскомментировать
            /*Yii::$app->mailer->compose('recovery_password', ['userHash' => $recoveryPassword->userHash])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($user->email)
                ->setSubject('Запрос на восстановление пароля на сайте EasyRent')
                ->send();*/

            return $this->renderAjax('_forgot_password_body', ['recoveryPassword' => $recoveryPassword, 'success' => true]);
        }

        return $this->renderAjax('_forgot_password_body', ['recoveryPassword' => $recoveryPassword]);
    }

    /**
     * @param null|string $userHash
     * @return string
     * @throws ErrorException
     * @throws NotFoundHttpException
     */
    public function actionSetNewPassword($userHash = null)
    {
        $userNewPassword = new UserRegisterForm(['scenario' => UserRegisterForm::SCENARIO_SET_NEW_PASSWORD]);

        if ($userNewPassword->load(Yii::$app->request->post()) && $userNewPassword->validate()) {
            $user = User::findOne(['email' => $userNewPassword->email]);
            $user->setNewPassword($userNewPassword->password);

            if (!$user->save(false)) {
                throw new ErrorException();
            }
            RecoveryPassword::deleteAll(['userId' => $user->id]);

            return $this->renderAjax('_set_new_password_body', ['success' => true]);
        }

        $recoveryPassword = RecoveryPassword::findOne(['userHash' => $userHash]);
        if (!$recoveryPassword || !User::findOne($recoveryPassword->userId)) {
            throw new NotFoundHttpException();
        }

        return $this->render('@app/views/site/index', [
            'userNewPassword' => $userNewPassword,
            'userEmail' => $recoveryPassword->user->email
        ]);
    }
}