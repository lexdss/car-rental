<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $car_id
 * @property integer $days
 * @property integer $discount
 */
class Discount extends ActiveRecord
{
    const MIN_DISCOUNT = 1;
    const MAX_DISCOUNT = 99;

    const MIN_DAYS = 1;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'discount';
    }
}