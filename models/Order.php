<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;
use app\models\helpers\DiscountHelper;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $price // TODO переименовать
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
            ['status', 'default', 'value' => 0],
            [['start_rent', 'end_rent'], 'required'],
            ['start_rent', 'date', 'timestampAttribute' => 'start_rent'],
            ['end_rent', 'date', 'timestampAttribute' => 'end_rent'],
            ['car_id', 'default', 'value' => function($model) {
                return $model->car->id;
            }],
            ['user_id', 'default', 'value' => function() {
                return Yii::$app->user->identity->getId();
            }],
            ['company_id', 'default', 'value' => function($model) {
                return $model->car->company->id;
            }],
            ['price', 'default', 'value' => function($model) {
                return $model->getAmount();
            }]
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

    /**
     * Discount for this order
     *
     * @return int
     */
    public function getDiscount()
    {
        return DiscountHelper::getDiscount($this->getDays(), $this->car_id);
    }

    /**
     * How many days
     *
     * @return mixed
     */
    public function getDays()
    {
        return DiscountHelper::getDays($this->start_rent, $this->end_rent);
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return DiscountHelper::getAmount($this->car->price, $this->getDiscount());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @param \app\models\Car $value
     */
    public function setCar($value)
    {
        $this->car = $value;
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

    /**
     * @return string
     */
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
