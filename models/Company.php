<?php

namespace app\models;

use yii\db\ActiveRecord;

class Company extends ActiveRecord
{

	public function attributeLabels()
	{

		return [
			'name' => 'Название',
			'logo' => 'Логотип'
		];

	}

	public function rules()
	{

		return [
			[['name', 'logo'], 'required', 'message' => 'Не заполнено'],
			['logo', 'image', 'extensions' => ['jpg', 'gif', 'png'], 'maxSize' => 1024 * 1024 * 5, 'notImage' => 'Это не изображение', 'tooBig' => 'До 5 мб']
		];

	}

}