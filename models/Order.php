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
 * @property integer $carId
 * @property integer $userId
 * @property integer $amount
 * @property integer $status
 * @property integer $pickupDate
 * @property integer $dropOffDate
 * @property integer $createDate
 * @property string $userEmail
 * @property string $carFullName
 * @property string $statusName
 * @property integer $discount
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
        return '{{order}}';
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
                    self::EVENT_BEFORE_INSERT => 'createDate'
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
            [['pickupDate', 'dropOffDate'], 'required'],
            ['pickupDate', 'date', 'timestampAttribute' => 'pickupDate'],
            ['dropOffDate', 'date', 'timestampAttribute' => 'dropOffDate'],
            ['carId', 'default', 'value' => function($model) {
                return $model->car->id;
            }],
            ['userId', 'default', 'value' => function() {
                return Yii::$app->user->identity->getId(); //TODO проверка
            }],
            ['companyId', 'default', 'value' => function($model) {
                return $model->car->company->id;
            }],
            ['amount', 'default', 'value' => function($model) {
                /**
                 * @var Order $model
                 */
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
            'carId' => 'ID Автомобиля',
            'amount' => 'Цена',
            'pickupDate' => 'Начало аренды',
            'dropOffDate' => 'Конец аренды',
            'createDate' => 'Заказ создан',
            'userId' => 'ID пользователя',
            'status' => 'Статус',
        ];
    }

    /**
     * Discount for this order
     * @return int
     */
    public function getDiscount()
    {
        $discount = Discount::find()->where(['carId' => $this->car->id])
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
        $start = new \DateTime($this->pickupDate);
        $end = new \DateTime($this->dropOffDate);

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
        return $this->hasOne(Car::className(), ['id' => 'carId']);
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
        return $this->hasOne(User::className(), ['id' => 'userId']);
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
    public function getCarFullName()
    {
        return $this->car->fullName;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return (self::STATUSES[$this->status]) ?: 'Ошибка';
    }

    /**
     * @return string
     */
    public function getStartRent()
    {
        return Yii::$app->formatter->asDate($this->pickupDate);
    }

    /**
     * @return string
     */
    public function getEndRent()
    {
        return Yii::$app->formatter->asDate($this->dropOffDate);
    }
}
