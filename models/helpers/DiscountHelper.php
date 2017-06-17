<?php

namespace app\models\helpers;

use app\models\Discount;

class DiscountHelper
{
    /**
     * How many days
     *
     * @param integer $start
     * @param integer $end
     *
     * @return integer
     */
    public static function getDays($start, $end)
    {
        $start = new \DateTime(date('Y-m-d', $start));
        $end = new \DateTime(date('Y-m-d', $end));

        return $start->diff($end)->days + 1;
    }

    /**
     * @param integer $days
     * @param integer $carId
     *
     * @return integer
     */
    public static function getDiscount($days, $carId)
    {
        $discount = Discount::find()->where(['car_id' => $carId])
            ->andWhere(['<=', 'days', $days])->orderBy(['days' => SORT_DESC])->one();

        if (!isset($discount->discount)) {
            return 0;
        }

        return $discount->discount;
    }

    /**
     * @param integer $carId
     *
     * @return integer
     */
    public static function getMaxDiscount($carId)
    {
        $max_discount = Discount::find()->where(['car_id' => $carId])->orderBy(['discount' => SORT_DESC])->one();

        return (isset($max_discount->discount)) ? $max_discount->discount : 0;
    }

    /**
     * @param integer $price
     * @param integer $discount
     *
     * @return integer
     */
    public static function getAmount($price, $discount)
    {
        return $price - ($price * $discount / 100);
    }
}