<?php

namespace app\components\validators;

use yii\validators\Validator;
use yii\validators\NumberValidator;
use app\models\Discount;

class DiscountValidator extends Validator
{
    protected function validateValue($value)
    {
        $numberValidator = new NumberValidator();
        $numberValidator->integerOnly = true;

        $days = [];
        $discount = [];
        $error = 'Проверьте правильность заполнения скидок (только целые числа больше нуля)';

        foreach ($value as $index => $item) {
            $days[$index] = $item['days'];
            $discount[$index] = $item['discount'];
        }

        $numberValidator->min = Discount::MIN_DAYS;
        foreach ($days as $index => $item) {
            if(!$numberValidator->validate($item)) {
                return $error;
            }
        }

        $numberValidator->min = Discount::MIN_DISCOUNT;
        $numberValidator->max = Discount::MAX_DISCOUNT;
        foreach ($discount as $index => $item) {
            if(!$numberValidator->validate($item)) {
                return $error;
            }
        }
    }
}