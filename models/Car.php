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

	public function rules()
	{
		return [
			[[
				'name',
				'model',
				'type',
				'year',
				'speed',
				'engine',
				'color',
				'transmission',
				'privod',
				'foto'
			], 'required', 'message' => 'Не заполнено'],
			[['name', 'engine', 'color'], 'string', 'length' => [2, 20], 'tooLong' => 'До 20 символов', 'tooShort' => 'От 2 символов'],
			['speed', 'integer', 'min' => 10, 'max' => 100, 'message' => 'Введите число', 'tooBig' => 'Слишком большая скорость', 'tooSmall' => 'Слишком маленькая скорость'],
			['description', 'string', 'max' => 2000, 'tooLong' => 'Слишком большое описание'],
			['foto', 'image', 'extensions' => ['jpg', 'gif', 'png'], 'maxSize' => 1024 * 1024 * 5, 'notImage' => 'Это не изображение', 'tooBig' => 'До 5 мб']
		];
	}
}