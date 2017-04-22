<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Car;
use app\models\Company;
use app\models\Category;
use app\models\Order;
use app\models\forms\UserRegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\OrderForm;

class SiteController extends Controller
{
    private $_car;
    private $_user;

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
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['register', 'login'],
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Car::find()->all();
        $companies = Company::find()->all();
        $categories = Category::find()->all();
        return $this->render('index', ['model' => $model, 'companies' => $companies, 'categories' => $categories]);
    }

    /**
     * Register user
     */
    public function actionRegister()
    {
        $model = new UserRegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->register();
            Yii::$app->session->setFlash('register', 'Вы успешно зарегистрированы');
        }

        return $this->render('register', ['model' => $model]);
    }

    /**
     * Login user
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->user->login($model->getUser());
            return $this->goHome();
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Car company page
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCompany()
    {
        if (!$company = Company::findOne(['slug' => Yii::$app->request->get('value')]))
            throw new NotFoundHttpException('Такая марка не найдена');
        $model = Car::findAll(['company_id' => $company->id]);

        return $this->render('company', ['model' => $model, 'company' => $company]);
    }

    /**
     * Detail car page
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCar()
    {
        if (!$model = Car::findOne(['slug' => Yii::$app->request->get('value')]))
            throw new NotFoundHttpException('Такой автомобиль не найден');

        return $this->render('detail', ['model' => $model]);
    }

    /**
     * Car's category
     */
    public function actionCategory()
    {
        if (!$category = Category::findOne(['slug' => Yii::$app->request->get('value')]))
            throw new NotFoundHttpException();

        $model = Car::find()->where(['category_id' => $category->id])->all();

        return $this->render('category', ['model' => $model, 'category' => $category]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionOrder()
    {
        if (!$this->_car = Car::findOne(Yii::$app->request->get('id'))) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        // For Ajax
        if (Yii::$app->request->get('start_rent')) {
            return $this->getAjaxOrderInfo();
        }

        // Create order and register if user is guest
        if (Yii::$app->request->post()) {

            if (Yii::$app->user->isGuest) {
                $this->_user = $this->userRegiser();
            }

            $this->saveOrder();
        }

        return $this->render('order', [
            'orderModel' => new OrderForm(),
            'registerModel' => new UserRegisterForm(),
            'car' => $this->_car
        ]);
    }

    private function getAjaxOrderInfo()
    {
        $request = Yii::$app->request;
        return $this->_car->getPriceForTime($request->get('start_rent'), $request->get('end_rent'));
    }

    private function userRegiser()
    {
        $registerModel = new UserRegisterForm();

        if ($registerModel->load(Yii::$app->request->post()) && $registerModel->validate()) {
            $user = $registerModel->register();
            return $user;
        }// TODO Исключение
    }

    private function saveOrder()
    {
        $orderModel = new OrderForm();

        if($orderModel->load(Yii::$app->request->post()) && $orderModel->validate()) {
            $orderModel->user_id = ($this->_user->primaryKey) ?: Yii::$app->user->identity->primaryKey;
            $orderModel->price = $this->_car->fullPrice;
            $orderModel->car_id = $this->_car->id;

            if ($orderModel->save()) {
                Yii::$app->session->setFlash('orderConfirm', 'Ваш заказ принят');

                return $this->render('order');
            }// TODO Исключение
        }
    }
}
