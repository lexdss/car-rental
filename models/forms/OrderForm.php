<?php

namespace app\models\forms;

class OrderForm extends \yii\base\Model
{
    public $car_id;
    public $price;
    public $start_rent;
    public $end_rent;

    public function rules()
    {
        return [
            [['start_rent', 'end_rent'], 'required'],
            ['start_rent', 'date', 'timestampAttribute' => 'start_rent'],
            ['end_rent', 'date', 'timestampAttribute' => 'end_rent'],
            ['end_rent', 'compare', 'compareAttribute' => 'start_rent', 'operator' => '>=', 'type' => 'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => 'Цена',
            'start_rent' => 'Начало аренды',
            'end_rent' => 'Конец аренды',
            'create_date' => 'Время заказа',
        ];
    }

    public function save()
    {
        // save
    }


}