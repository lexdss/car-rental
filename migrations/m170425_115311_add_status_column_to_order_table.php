<?php

use yii\db\Migration;

/**
 * Handles adding status to table `order`.
 */
class m170425_115311_add_status_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'status', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'status');
    }
}
