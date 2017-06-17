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
use app\models\helpers\DiscountHelper;

/**
 * Class SiteController
 */
class SiteController extends Controller
{
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
     * Displays homepage
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => Car::find()->all(),
            'companies' => Company::find()->all(),
            'categories' => Category::find()->all()
        ]);
    }

    /**
     * Car company page
     * @param string $value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCompany($value)
    {
        if (!$company = Company::findOne(['slug' => $value]))
            throw new NotFoundHttpException('Такая марка не найдена');

        $model = Car::findAll(['company_id' => $company->id]);

        return $this->render('company', ['model' => $model, 'company' => $company]);
    }

    /**
     * Detail car page
     * @param string $value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCar($value)
    {
        if (!$model = Car::findOne(['slug' => $value]))
            throw new NotFoundHttpException('Такой автомобиль не найден');

        return $this->render('detail', ['model' => $model]);
    }

    /**
     * Car's category
     * @param string $value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($value)
    {
        if (!$category = Category::findOne(['slug' => $value]))
            throw new NotFoundHttpException();

        $model = Car::find()->where(['category_id' => $category->id])->all();

        return $this->render('category', ['model' => $model, 'category' => $category]);
    }

    /**
     * Create (and register user) new order
     * @param int $id
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
            $days = DiscountHelper::getDays(strtotime(Yii::$app->request->get('start_rent')), strtotime(Yii::$app->request->get('end_rent')));

            $data['discount'] = DiscountHelper::getDiscount($days, $car->id);
            $data['amount'] = DiscountHelper::getAmount($car->price, $data['discount']);

            return json_encode($data);
        }

        // Register User and save Order
        if (Yii::$app->request->isPost) {
            if (Yii::$app->user->isGuest && $userRegisterForm->load(Yii::$app->request->post()))
                $userRegisterForm->register();

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
