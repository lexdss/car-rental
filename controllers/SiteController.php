<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use app\models\Car;
use app\models\Company;
use app\models\Category;
use app\models\Page;
use app\models\forms\UserRegisterForm;
use app\models\helpers\DiscountHelper;
use app\models\Order;
use vova07\imperavi\actions\GetAction;

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
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::getAlias('@uploadweb'),
                'path' => Yii::getAlias('@uploadroot')
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::getAlias('@uploadweb'),
                'path' => Yii::getAlias('@uploadroot'),
                'type' => GetAction::TYPE_IMAGES
            ]
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

        return $this->render('company', ['company' => $company]);
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

        return $this->render('category', ['category' => $category]);
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

            $data['days'] = $days;
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
                Yii::$app->session->setFlash('order', 'Ваш заказ принят');

                return $this->render('order');
            }
        }

        return $this->render('order', [
            'orderModel' => $order,
            'registerModel' => $userRegisterForm,
            'car' => $car
        ]);
    }

    /**
     * Single page
     * @param string $type
     * @param string $value
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPage($type, $value)
    {
        if (!$model = Page::findOne(['slug' => $value, 'type' => $type])) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        if ($type == Page::SCENARIO_NEWS) {
            $moreNews = Page::find()->where(['type' => $type])
                ->andWhere(['not in', 'slug', [$value]])
                ->limit(2)
                ->orderBy(['id' => SORT_DESC])
                ->all();

            return $this->render('single-news', ['model' => $model, 'moreNews' => $moreNews]);
        } elseif ($type == Page::SCENARIO_PAGE) {
            return $this->render('single-page', ['model' => $model]);
        }

        throw new NotFoundHttpException('Страница не найдена');
    }

    /**
     * All news
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionNews()
    {
        $models = Page::find()->where(['type' => Page::SCENARIO_NEWS])->all();

        return $this->render('news', ['models' => $models]);
    }
}
