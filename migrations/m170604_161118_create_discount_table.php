<?php

use yii\db\Migration;

/**
 * Handles the creation of table `discount`.
 */
class m170604_161118_create_discount_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('discount', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(),
            'days' => $this->integer()->notNull(),
            'discount' => $this->integer()->notNull()
        ]);
        $this->createIndex('idx-car_id', 'discount', 'car_id');
        $this->addForeignKey('fk-car_id', 'discount', 'car_id', 'car', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-car_id', 'discount');
        $this->dropIndex('idx-car_id', 'discount');
        $this->dropTable('discount');
    }
}
