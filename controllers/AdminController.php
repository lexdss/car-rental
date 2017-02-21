<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Car;
use app\models\Company;

class AdminController extends Controller
{

	public $layout = 'admin';

	public function actionIndex()
	{

		return $this->render('index');

	}

	public function actionAddCar()
	{
		$request = \Yii::$app->request;
		$model = new Car;

		if ( $request->isPost && $model->load($request->post()) ) {
			
			$model->foto = UploadedFile::getInstance($model, 'foto');

			if ($model->validate()) {
				$fname = \Yii::$app->security->generateRandomString(15);
				$path = '/' . $fname . '.' . $model->foto->extension;
				$model->foto->saveAs(\Yii::getAlias('@uploadroot') . $path);
				$model->foto = \Yii::getAlias('@upload') . $path;
				$model->save(false);

				\Yii::$app->session->setFlash('message', 'Авто добавлено');
        		return $this->redirect(['admin/add-car']);
			}

		}

		return $this->render('add-car', ['model' => (new Car)]);
		
	}

	public function actionAddCompany()
	{

		$request = \Yii::$app->request;
		$model = new Company;

		if ( $request->isPost && $model->load($request->post()) ) {

			$model->logo = UploadedFile::getInstance($model, 'logo');

			if ($model->validate()) {
				$fname = \Yii::$app->security->generateRandomString(5);
				$path = '/' . $fname . '.' . $model->logo->extension;
				$model->logo->saveAs(\Yii::getAlias('@uploadroot') . $path);
				$model->logo = \Yii::getAlias('@upload') . $path;
				$model->save(false);

        		\Yii::$app->session->setFlash('message', 'Марка добавлена');
        		return $this->redirect(['admin/add-company']);
			}

		}

		return $this->render('add-company', ['model' => $model]);

	}

}