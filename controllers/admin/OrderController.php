<?php

namespace app\controllers\admin;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\admin\search\OrderSearch;
use app\models\Order;

class OrderController extends AdminController
{
    /**
     * Order's list
     * @inheritdoc
     */
    public function actionIndex()
    {
        $orderSearch = new OrderSearch();
        $dataProvider = $orderSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $orderSearch
        ]);
    }

    /**
     * Order details
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Update order status
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * @param $id
     * @return Order model
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена');
        }
    }
}