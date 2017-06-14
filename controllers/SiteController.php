<?php

namespace app\controllers;

use app\models\Order;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Car;
use app\models\Company;
use app\models\Category;
use app\models\forms\UserRegisterForm;
use app\models\helpers\OrderHelper;

/**
 * Class SiteController
 *
 * @property \app\models\Car $_car
 */
class SiteController extends Controller
{
    private $_car;

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
     * Create (and register user) new order
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionOrder($id)
    {
        if (!$car = Car::findOne($id))
            throw new NotFoundHttpException('Страница не найдена');

        $order = new Order();

        $userRegisterForm = new UserRegisterForm();

        if (Yii::$app->request->isAjax) {
            $days = OrderHelper::getDays(strtotime(Yii::$app->request->get('start_rent')), strtotime(Yii::$app->request->get('end_rent')));

            $data['discount'] = OrderHelper::getDiscount($days, $car->id);
            $data['amount'] = OrderHelper::getAmount($car->price, $data['discount']);

            return json_encode($data);
        }

        // Register User and save Order
        if (Yii::$app->request->isPost) {
            if (Yii::$app->user->isGuest && $userRegisterForm->load(Yii::$app->request->post())) {
                $userRegisterForm->register();
            }

            $order->car = $car;

            if ($order->load(Yii::$app->request->post()) && $order->save()) {
                Yii::$app->session->setFlash('orderConfirm', 'Ваш заказ принят');

                return $this->render('order');
            }
        }

        return $this->render('order', [
            'orderModel' => $order,
            'registerModel' => $userRegisterForm,
            'car' => $car
        ]);
    }
}
