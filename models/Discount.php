<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $carId
 * @property integer $days
 * @property integer $discount
 */
class Discount extends ActiveRecord
{
    public $car_discount;

    const MIN_DISCOUNT = 1;
    const MAX_DISCOUNT = 99;

    const MIN_DAYS = 1;
    const MAX_DAYS = 365;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{discount}}';
    }

    public function attributeLabels()
    {
        return [
            'days' => 'Дни',
            'discount' => 'Скидка',
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['discount', 'days'], 'trim'],
            ['discount', 'integer', 'min' => self::MIN_DISCOUNT, 'max' => self::MAX_DISCOUNT],
            ['days', 'integer', 'min' => self::MIN_DAYS, 'max' => self::MAX_DAYS],
            [['discount', 'days'], 'required']
        ];
    }
}