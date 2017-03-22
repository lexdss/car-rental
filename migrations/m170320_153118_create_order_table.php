<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170320_153118_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'start_rent' => $this->date()->notNull(),
            'end_rent' => $this->date()->notNull()
        ]);

        $this->createIndex('idx-order-car_id', 'order', 'car_id');

        $this->addForeignKey(
            'fk-order-car_id',
            'order',
            'car_id',
            'car',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-order-car_id', 'order');
        $this->dropIndex('idx-order-car_id', 'order');
        $this->dropTable('order');
    }
}
