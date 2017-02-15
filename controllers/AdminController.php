<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Car;

class AdminController extends Controller
{

	public $layout = 'admin';

	public function actionAdd()
	{
		$model = new Car;
		return $this->render('add_car', ['model' => $model]);
	}

}