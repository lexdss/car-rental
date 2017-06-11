<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $price
 * @property integer $status
 * @property integer $start_rent
 * @property integer $end_rent
 * @property integer $create_date
 * @property integer $user_id
 * @property integer $company_id
 *
 * @property Car $car
 * @property User $user
 */
class Order extends ActiveRecord
{

    public $car;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'create_date'
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            //['start_rent', 'date', 'timestampAttribute' => 'start_rent'],
            //['end_rent', 'date', 'timestampAttribute' => 'end_rent'],
            ['status', 'default', 'value' => 0]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'ID Автомобиля',
            'price' => 'Цена',
            'start_rent' => 'Начало аренды',
            'end_rent' => 'Конец аренды',
            'create_date' => 'Заказ создан',
            'user_id' => 'ID пользователя',
            'status' => 'Статус',
            'statusLine' => 'Статус',
            'userEmail' => 'Пользователь',
            'carFullName' => 'Автомобиль',
        ];
    }

    public function getAjaxOrderInfo()
    {
        //$start_rent = new \DateTime($this->start_rent);
        //$end_rent = new \DateTime($this->end_rent);

        //$data['discount'] = $this->getOrderDiscount();
        $data['discount'] = $this->getOrderDiscount();
        $data['amount'] = $this->getOrderAmount();
        return json_encode($data);
    }

    public function getOrderDiscount()
    {
        $discount = Discount::find()->where(['car_id' => $this->car->id])
            ->andWhere(['<=', 'days', $this->getOrderDays()])->orderBy(['days' => SORT_DESC])->one();

        if (!isset($discount->discount)) {
            return 0;
        }

        return $discount->discount;
    }

    public function getOrderDays()
    {
        $start_rent = new \DateTime(date('Y-m-d', $this->start_rent));
        $end_rent = new \DateTime(date('Y-m-d', $this->end_rent));

        return $start_rent->diff($end_rent)->days + 1;
    }

    public function getOrderAmount()
    {
        return $this->car->price - ($this->car->price * $this->getOrderDiscount() / 100);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    public function getUserEmail()
    {
        return $this->user->email;
    }

    /**
     * @return string
     */
    public function getStatusLine()
    {
        return (Yii::$app->params['orderStatus'][$this->status]) ?: 'Ошибка';
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return Yii::$app->params['orderStatus'];
    }

    /**
     * @return mixed
     */
    public function getCarFullName()
    {
        return $this->car->fullName;
    }
}
