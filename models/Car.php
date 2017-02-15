<?php

namespace app\models;

use yii\base\Model;

class Car extends Model
{
	public $name;
	public $model;
	public $type;
	public $year;
	public $speed;
	public $engine;
	public $color;
	public $transmission;
	public $privod;
	public $description;
	public $foto;

	public function attributeLabels()
	{
		return [
			'name' => 'Название',
			'model' => 'Модель',
			'type' => 'Класс авто',
			'year' => 'Год производства',
			'speed' => 'Скорость',
			'engine' => 'Двигатель',
			'color' => 'Цвет',
			'transmission' => 'КПП',
			'privod' => 'Привод',
			'description' => 'Описание',
			'foto' => 'Фото',
		];
	}
}