<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170323_162306_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'carId' => $this->integer()->notNull(),
            'userId' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'pickupDate' => $this->integer()->notNull(),
            'dropOffDate' => $this->integer()->notNull(),
            'status' => $this->integer(1)->notNull(),
            'createDate' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-order-carId', 'order', 'carId');
        $this->addForeignKey(
            'fk-order-carId',
            'order',
            'carId',
            'car',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-order-userId', 'order', 'userId');
        $this->addForeignKey(
            'fk-order-userId',
            'order',
            'userId',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order-userId', 'order');
        $this->dropIndex('idx-order-userId', 'order');
        $this->dropForeignKey('fk-order-carId', 'order');
        $this->dropIndex('idx-order-carId', 'order');
        $this->dropTable('order');
    }
}
