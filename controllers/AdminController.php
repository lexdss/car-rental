<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\Car;
use app\models\Company;

class AdminController extends Controller
{

	public $layout = 'admin';

	public function actionIndex()
	{
		return $this->render('index');
	}

	/*
	* Add car page
	*/
	public function actionAddCar()
	{
		$request = \Yii::$app->request;
		$model = new Car;

		if ( $request->isPost && $model->load($request->post()) ) {
			$this->saveModel($model, 'car');

			\Yii::$app->session->setFlash('message', 'Авто добавлено');
        	return $this->redirect(['admin/add-car']);
		}

		$company = ['' => ''] + ArrayHelper::map(Company::find()->orderBy(['id' => SORT_DESC])->asArray()->all(), 'id', 'name');

		return $this->render('add-car', ['model' => (new Car), 'company' => $company]);
	}

	/*
	* Add company page
	*/
	public function actionAddCompany()
	{
		$request = \Yii::$app->request;
		$model = new Company;

		if ( $request->isPost && $model->load($request->post()) ) {
			$this->saveModel($model, 'company');
			\Yii::$app->session->setFlash('message', 'Марка добавлена', false);

     		return $this->redirect(['admin/add-' . $type]);
		}

		return $this->render('add-company', ['model' => $model]);
	}

	/*
	* All company list
	*/
	public function actionCompany()
	{
		$model = Company::find()->orderBy(['id' => SORT_DESC])->asArray()->all();

		return $this->render('company', ['model' => $model]);
	}

	/*
	* Change company page
	*/
	public function actionChangeCompany()
	{
		if (!$model = Company::findOne(\Yii::$app->request->get('id')))
			throw new NotFoundHttpException('Такой страницы не существует');

		$model->scenario = Company::SCENARIO_CHANGE;

		if (\Yii::$app->request->isPost){
			$change_model = new Company;
			$change_model->load(\Yii::$app->request->post());

			$model->img = $this->saveFile(UploadedFile::getInstance($change_model, 'img')) ?: $model->img;
			$model->name = $change_model->name;
			$model->save();

			return $this->redirect(['admin/company']);
		}
		

		return $this->render('company-change', ['model' => $model]);
	}

	private function saveModel($model, $type)
	{
		$model->img = UploadedFile::getInstance($model, 'img');

		if ($model->validate()) {
			$model->img = $this->saveFile($model->img);
			$model->save(false);
		}
	}

	/**
	* @return path
	*/
	private function saveFile($file)
	{
		if (!$file instanceof UploadedFile)
			return false;

		$fname = \Yii::$app->security->generateRandomString(15);
		$path = '/' . $fname . '.' . $file->extension;
		$file->saveAs(\Yii::getAlias('@uploadroot') . $path);
		
		return \Yii::getAlias('@upload') . $path;
	}

}