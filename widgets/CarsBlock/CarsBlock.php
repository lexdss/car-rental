<?php

namespace app\widgets\CarsBlock;

use yii\base\Widget;
use app\models\Car;

class CarsBlock extends Widget
{
	public $option; // company || type
	public $count;
	public $value;
	public $model;

	public function init()
	{
		parent::init();

		$this->count = $this->count ?: 4;

		switch ($this->option) {
			case 'company':
				$this->model = Car::find()->where(['company_id' => $this->value])->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;

			case 'type':
				$this->model = Car::find()->where(['type' => $this->value])->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;
			
			default:
				$this->model = Car::find()->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;
		}
	}

	public function run()
	{
		return $this->render('index', ['model' => $this->model]);
	}
}