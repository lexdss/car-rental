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
            'carId' => $this->integer(),
            'days' => $this->integer(3)->notNull(),
            'discount' => $this->integer(2)->notNull()
        ]);
        $this->createIndex('idx-discount-carId', 'discount', 'carId');
        $this->addForeignKey('fk-discount-carId', 'discount', 'carId', 'car', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-discount-carId', 'discount');
        $this->dropIndex('idx-discount-carId', 'discount');
        $this->dropTable('discount');
    }
}
