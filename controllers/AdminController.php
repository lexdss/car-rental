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
	* All car list
	*/
	public function actionCar()
	{
		$model = Car::find()->orderBy(['id' => SORT_DESC])->all();

		if ($id = \Yii::$app->request->get('del'))
			$this->deleteCar($id);

		return $this->render('car', ['model' => $model]);
	}

	/*
	* Add car page
	*/
	public function actionAddCar()
	{
		$request = \Yii::$app->request;
		$model = new Car;

		if ( $request->isPost && $model->load($request->post()) ) {
			$this->saveModel($model);

			\Yii::$app->session->setFlash('message', 'Авто добавлено');
        	return $this->redirect(['admin/add-car']);
		}

		$company = ArrayHelper::map(Company::find()->orderBy(['id' => SORT_DESC])->asArray()->all(), 'id', 'name'); // For dropDown list

		return $this->render('add-car', ['model' => (new Car), 'company' => $company]);
	}

	public function actionChangeCar()
	{
		if (!$model = Car::findOne(\Yii::$app->request->get('id')))
			throw new NotFoundHttpException('Такой страницы не существует');
		$company = ArrayHelper::map(Company::find()->orderBy(['id' => SORT_DESC])->asArray()->all(), 'id', 'name'); // For dropDown list

		$model->scenario = Company::SCENARIO_CHANGE;

		if (\Yii::$app->request->isPost){
			$changeModel = new Car;
			$this->changeModel($model, $changeModel);

			return $this->redirect(['admin/car']);
		}

		return $this->render('change-car', ['model' => $model, 'company' => $company]);
	}

	public function deleteCar($id)
	{
		if (!$model = Car::findOne($id))
			throw new NotFoundHttpException('Такой автомобиль не найден');

		if ($model->delete())
			\Yii::$app->response->redirect(['admin/car'])->send();
		return;
	}

	/*
	* All company list
	*/
	public function actionCompany()
	{
		$model = Company::find()->orderBy(['id' => SORT_DESC])->all();

		if ($id = \Yii::$app->request->get('del'))
		    $this->deleteCompany($id);

		return $this->render('company', ['model' => $model]);
	}

	/*
	* Add company page
	*/
	public function actionAddCompany()
	{
		$request = \Yii::$app->request;
		$model = new Company;

		if ( $request->isPost && $model->load($request->post()) ) {
			$this->saveModel($model);
			\Yii::$app->session->setFlash('message', 'Марка добавлена', false);

     		return $this->redirect(['admin/add-company']);
		}

		return $this->render('add-company', ['model' => $model]);
	}

    public function deleteCompany($id)
    {
        if (!$model = Company::findOne($id))
            throw new NotFoundHttpException('Такая марка не найдена');

        if ($model->delete())
            \Yii::$app->response->redirect(['admin/company'])->send();
        return;
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
			$changeModel = new Company;
			$this->changeModel($model, $changeModel);

			return $this->redirect(['admin/company']);
		}
		
		return $this->render('change-company', ['model' => $model]);
	}

	private function saveModel($model)
	{
		$model->img = UploadedFile::getInstance($model, 'img');

		if ($model->validate()) {
			$model->img = $this->saveFile($model->img);
			$model->save(false);
		}
	}

	private function changeModel($model, $changeModel)
	{
		$changeModel->load(\Yii::$app->request->post());
		$changeModel->img = $this->saveFile(UploadedFile::getInstance($changeModel, 'img')) ?: $model->img;
		$model->attributes = $changeModel->toArray();

		$model->save();
	}

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