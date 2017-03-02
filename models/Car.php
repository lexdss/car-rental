<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Company;

class Car extends ActiveRecord
{

	const SCENARIO_CHANGE = 'change';
	
	public function attributeLabels()
	{
		return [
			'name' => 'Название',
			'company_id' => 'Модель',
			'type' => 'Класс авто',
			'year' => 'Год производства',
			'speed' => 'Скорость',
			'engine' => 'Двигатель',
			'color' => 'Цвет',
			'transmission' => 'КПП',
			'privod' => 'Привод',
			'description' => 'Описание',
			'img' => 'Фото',
		];
	}

	public function rules()
	{
		return [
			[[
				'name',
				'company_id',
				'type',
				'year',
				'speed',
				'engine',
				'color',
				'transmission',
				'privod',
				'img'
			], 'required', 'message' => 'Не заполнено', 'except' => self::SCENARIO_CHANGE],
			[['name', 'engine', 'color'], 'string', 'length' => [2, 20], 'tooLong' => 'До 20 символов', 'tooShort' => 'От 2 символов'],
			['speed', 'integer', 'min' => 10, 'max' => 100, 'message' => 'Введите число', 'tooBig' => 'Слишком большая скорость', 'tooSmall' => 'Слишком маленькая скорость'],
			['description', 'string', 'max' => 2000, 'tooLong' => 'Слишком большое описание'],
			['img', 'image', 'extensions' => ['jpg', 'gif', 'png'], 'maxSize' => 1024 * 1024 * 5, 'notImage' => 'Это не изображение', 'tooBig' => 'До 5 мб'],
			[[
				'name',
				'company_id',
				'type',
				'year',
				'speed',
				'engine',
				'color',
				'transmission',
				'privod'
			], 'required', 'message' => 'Не заполнено', 'on' => self::SCENARIO_CHANGE],
		];
	}

	public function getCompany()
	{
		return $this->hasOne(Company::className(), ['id' => 'company_id']);
	}

	public function getFullName()
	{
		return $this->company->name . ' ' . $this->name;
	}
	
}