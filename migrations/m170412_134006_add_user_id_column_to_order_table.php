<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `order`.
 */
class m170412_134006_add_user_id_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'user_id', $this->integer());
        $this->createIndex('idx-user_id', 'order', 'user_id');
        $this->addForeignKey('fk-user_id', 'order', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_id', 'order');
        $this->dropIndex('idx-user_id', 'order');
        $this->dropColumn('order', 'user_id');
    }
}
