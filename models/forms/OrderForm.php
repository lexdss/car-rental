<?php

namespace app\models\forms;

use app\models\Car;
use Yii;
use app\models\Order;

class OrderForm extends \yii\base\Model
{
    public $user_id;
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
        $order = new Order();
        $car = Car::findOne($this->car_id);

        $order->car_id = $this->car_id;
        $order->start_rent = $this->start_rent;
        $order->end_rent = $this->end_rent;
        $order->price = $car->getAmount($car->getDiscount($this->start_rent, $this->end_rent));
        $order->user_id = $this->user_id;

        return $order->save(false);
    }
}