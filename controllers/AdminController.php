<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Car;
use yii\web\UploadedFile;

class AdminController extends Controller
{

	public $layout = 'admin';

	public function actionAdd()
	{
		$request = \Yii::$app->request;
		$model = new Car;

		if ($request->isPost && $model->load($request->post())) {
			
			$model->foto = UploadedFile::getInstance($model, 'foto');

			if ($model->validate()) {

				$path = '/' . $model->foto->baseName . '.' . $model->foto->extension;
				$model->foto->saveAs(\Yii::getAlias('@uploadroot') . $path);
				$model->foto = \Yii::getAlias('@upload') . $path;
				$model->save(false);

			}

		}

		return $this->render('add_car', ['model' => (new Car)]);
		
	}

}