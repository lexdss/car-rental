<?php

namespace app\widgets\CarsBlock;

use yii\base\Widget;
use app\models\Car;

class CarsBlock extends Widget
{
	public $option;
	public $count;
	public $value;
	public $except;
	public $model;

	public function init()
	{
		parent::init();

		$this->count = $this->count ?: 4;
		$this->except = $this->except ?: '';

		switch ($this->option) {
			case 'company':
				$this->model = Car::find()->where(['company_id' => $this->value])->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;

			case 'category':
				$this->model = Car::find()->where(['and', 'category_id=' . "'$this->value'", ['not in', 'id', [$this->except]]])->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;

            case 'car':
                $this->model = Car::find()->where(['id' => $this->value])->all();
                break;
			
			default:
				$this->model = Car::find()->orderBy(['id' => SORT_DESC])->limit($this->count)->all();
				break;
		}
	}

	public function run()
	{
		return $this->render('index', ['model' => $this->model, 'option' => $this->option]);
	}
}