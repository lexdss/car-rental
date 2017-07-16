<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;
use app\components\behaviors\SendEmailBehavior;

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
 * @property string $statusName
 * @property string $carFullName
 * @property string $startRent
 * @property string $endRent
 *
 * @property Car $car
 * @property User $user
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_CLOSE = 3;

    const STATUSES = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_PROCESSING => 'В обработке',
        self::STATUS_ACTIVE => 'Активный',
        self::STATUS_CLOSE => 'Завершен'
    ];

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
            ],
            [
                'class' => SendEmailBehavior::className()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_NEW],
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
     * @return mixed
     */
    public function getCarFullName()
    {
        return $this->car->fullName;
    }

    public function getStatusName()
    {
        return (self::STATUSES[$this->status]) ?: 'Ошибка';
    }

    /**
     * @return string
     */
    public function getStartRent()
    {
        return Yii::$app->formatter->asDate($this->start_rent);
    }

    /**
     * @return string
     */
    public function getEndRent()
    {
        return Yii::$app->formatter->asDate($this->end_rent);
    }
}
