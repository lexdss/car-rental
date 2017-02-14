<?php

namespace app\controllers;

use yii\web\Controller;

class AdminController extends Controller
{

	public $layout = 'admin';

	public function actionAdd()
	{
		return $this->render('add_car');
	}
	
}