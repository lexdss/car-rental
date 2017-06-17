<?php

namespace app\components\validators;

use yii\validators\Validator;
use app\models\Discount;

/**
 * Load errors in Car discount attribute. Validation in Discount model
 */
class DiscountValidator extends Validator
{
    /**
     * @param \app\models\Car $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        foreach ($model->{$attribute} as $index => $item) {

            // If no discounts
            if (count($model->{$attribute}) == 1 && empty($item['days']) && empty($item['discount'])) {
                $model->{$attribute} = null;
                return;
            }

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