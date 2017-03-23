<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_order`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `order`
 */
class m170323_162739_create_junction_table_for_user_and_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_order', [
            'user_id' => $this->integer(),
            'order_id' => $this->integer(),
            'PRIMARY KEY(user_id, order_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_order-user_id',
            'user_order',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_order-user_id',
            'user_order',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `order_id`
        $this->createIndex(
            'idx-user_order-order_id',
            'user_order',
            'order_id'
        );

        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-user_order-order_id',
            'user_order',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_order-user_id',
            'user_order'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_order-user_id',
            'user_order'
        );

        // drops foreign key for table `order`
        $this->dropForeignKey(
            'fk-user_order-order_id',
            'user_order'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            'idx-user_order-order_id',
            'user_order'
        );

        $this->dropTable('user_order');
    }
}
