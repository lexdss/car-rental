<?php 

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Car;

class CarController extends Controller
{
	public function actionIndex()
	{
		if (!$model = Car::find()->where(['car.id' => \Yii::$app->request->get('id')])->one())
			throw new HotFoundHttpException('Страница не найдена');
		return $this->render('detail-page', ['model' => $model]);
	}
}