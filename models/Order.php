<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;

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
 * @property integer $discount
 * @property integer $days
 * @property integer $amount
 * @property string $userEmail
 * @property string $statusLine
 * @property array|string $statusList
 * @property string $carFullName
 * @property string $startRent
 * @property string $endRent
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => 0],
            [['start_rent', 'end_rent'], 'required'],
            ['start_rent', 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'start_rent'],
            ['end_rent', 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'end_rent'],
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

    /**
     * @inheritdoc
     */
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
     * @return int
     */
    public function getDiscount()
    {
        $discount = Discount::find()->where(['car_id' => $this->car->id])
            ->andWhere(['<=', 'days', $this->getDays()])
            ->orderBy(['days' => SORT_DESC])
            ->one();

        return (isset($discount->discount)) ? $discount->discount : 0;
    }

    /**
     * How many days
     * @return integer
     */
    public function getDays()
    {
        $start = new \DateTime($this->startRent);
        $end = new \DateTime($this->endRent);

        return $start->diff($end)->days + 1;
    }

    /**
     * @return integer
     */
    public function getAmount()
    {
        return $this->car->price - ($this->car->price * $this->getDiscount() / 100);
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

    /**
     * @return string
     */
    public function getStartRent()
    {
        return Yii::$app->formatter->asDate($this->start_rent, 'php:d.m.Y');
    }

    /**
     * @return string
     */
    public function getEndRent()
    {
        return Yii::$app->formatter->asDate($this->end_rent, 'php:d.m.Y');
    }
}
