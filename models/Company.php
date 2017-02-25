<?php

namespace app\models;

use yii\db\ActiveRecord;

class Company extends ActiveRecord
{
	const SCENARIO_CHANGE = 'change';

	public function attributeLabels()
	{

		return [
			'name' => 'Название',
			'img' => 'Логотип'
		];

	}

	public function rules()
	{

		return [
			[['name', 'img'], 'required', 'message' => 'Не заполнено', 'except' => self::SCENARIO_CHANGE],
			['img', 'image', 'extensions' => ['jpg', 'gif', 'png'], 'maxSize' => 1024 * 1024 * 5, 'notImage' => 'Это не изображение', 'tooBig' => 'До 5 мб'],
			['name', 'required', 'message' => 'Не заполнено', 'on' => self::SCENARIO_CHANGE],
		];

	}

}