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
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена');
        }
    }
}