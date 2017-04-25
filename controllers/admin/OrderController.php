<?php

namespace app\controllers\admin;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\admin\search\OrderSearch;
use app\models\Order;

class OrderController extends AdminController
{
    /**
     * @return string
     */
    public function getViewPath()
    {
        return '@app/views/admin/order';
    }

    /**
     * Order's list
     *
     * @return string
     */
    public function actionIndex()
    {
        $orderSearch = new OrderSearch(['scenario' => OrderSearch::SCENARIO_SEARCH]);
        $dataProvider = $orderSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $orderSearch]);
    }

    public function actionView($id)
    {
        if (!$model = Order::findOne($id)) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', ['model' => $model]);
    }
}