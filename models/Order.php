<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
 *
 * @property Car $car
 * @property User $user
 */
class Order extends ActiveRecord
{
    // All statuses
    private $statusList = [
        1 => 'Новый',
        2 => 'В обработке',
        3 => 'Активный',
        4 => 'Завершен'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

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

    public function rules()
    {
        return [
            ['status', 'integer']
        ];
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
     * @return string
     */
    public function getStatusString()
    {
        return ($this->statusList[$this->status]) ?: 'Ошибка';
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return $this->statusList;
    }
}
