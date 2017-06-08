<?php

namespace app\components\validators;

use yii\validators\Validator;
use app\models\Discount;

/**
 * Load errors in Car discount attribute. Validattion in Discount model
 */
class DiscountValidator extends Validator
{
    /**
     * @param \app\models\Car $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        foreach ($model->car_discount as $index => $item) {
            $discount = new Discount();

            $discount->days = $item['days'];
            $discount->discount = $item['discount'];

            if (!$discount->validate()) {
                $errors = [];
                foreach ($discount->errors as $i => $v) {
                    $errors[ $attribute . '[' . $index . '][' . $i . ']' ] = $v;
                }
                $model->addErrors($errors);
            }
        }
    }
}