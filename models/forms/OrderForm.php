<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Order;
use app\models\Car;

class OrderForm extends Model
{
    public $user_id;
    public $car_id;
    public $price;
    public $start_rent;
    public $end_rent;
    public $status;

    public function rules()
    {
        return [
            [['start_rent', 'end_rent'], 'required'],
            ['start_rent', 'date', 'timestampAttribute' => 'start_rent'],
            ['end_rent', 'date', 'timestampAttribute' => 'end_rent'],
            ['end_rent', 'compare', 'compareAttribute' => 'start_rent', 'operator' => '>=', 'type' => 'number'],
            ['status', 'default', 'value' => 1]
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

    public function save($postData)
    {
        $order = new Order();
        $car = Car::findOne(Yii::$app->request->get('id'));

        if ($this->load($postData) && $this->validate()) {
            $order->start_rent = $this->start_rent;
            $order->end_rent = $this->end_rent;
            $order->status = $this->status;
            $order->car_id = $car->id;
            $order->price = $car->getAmount($car->getDiscount($this->start_rent, $this->end_rent));
            $order->user_id = Yii::$app->user->id;
        }

        if ($order->save(false)) {
            return $order;
        } else {
            return false;
        } // TODO Исключение
    }
}