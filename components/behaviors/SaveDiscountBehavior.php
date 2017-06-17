<?php

namespace app\components\behaviors;

use yii\base\Behavior;
use yii\base\ErrorException;
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

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveDiscount',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveDiscount'
        ];
    }

    /**
     * Save all discounts
     */
    public function saveDiscount()
    {
        if (!$this->owner->isNewRecord)
            Discount::deleteAll(['car_id' => $this->owner->id]);

        if (is_array($this->owner->{$this->attribute})) {

            foreach ($this->owner->{$this->attribute} as $item) {

                $discount = new Discount();
                $discount->car_id = $this->owner->id;
                $discount->days = $item['days'];
                $discount->discount = $item['discount'];

                if (!$discount->save(false))
                    throw new ErrorException('Ошбика БД при сохранении скидок');
            }
        }
    }
}