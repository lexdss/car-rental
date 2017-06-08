<?php

namespace app\components\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\Discount;

/**
 * Save Discount models
 *
 * @package app\components\behaviors
 *
 * @property \app\models\Car $owner
 */
class SaveDiscountBehavior extends Behavior
{
    public $attribute;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveDiscount',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveDiscount'
        ];
    }

    public function saveDiscount($event)
    {
        if (!$this->owner->isNewRecord) {
            Discount::deleteAll(['car_id' => $this->owner->id]);
        }

        foreach ($this->owner->{$this->attribute} as $item) {

            $discount = new Discount();
            $discount->car_id = $this->owner->id;
            $discount->days = $item['days'];
            $discount->discount = $item['discount'];

            $discount->save(false); // TODO Исключение
        }
    }
}