<?php 

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Car;

class CarController extends Controller
{
	public function actionIndex()
	{
		$model = Car::findOne(['code' => \Yii::$app->request->get('car')]);

		if (!$model || $model->company->code != \Yii::$app->request->get('company'))
			throw new NotFoundHttpException('Страница не найдена');

		return $this->render('detail-page', ['model' => $model]);
	}

	public function actionCompany()
	{
		if ( !$model = Car::find()->joinWith('company')->where(['company.code' => \Yii::$app->request->get('company')])->all() )
			throw new NotFoundHttpException('Страница не найдена');

		return $this->render('company', ['model' => $model, 'company' => $model[0]->company]);
	}

	public function actionType()
	{
	    if ( !$model = Car::find()->where(['type' => \Yii::$app->request->get('type')])->all() )
	        throw new NotFoundHttpException('Страница не найдена');

        return $this->render('type', ['model' => $model]);
	}
}