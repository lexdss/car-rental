<?php

use yii\db\Migration;

/**
 * Handles adding company_id to table `order`.
 */
class m170531_153733_add_company_id_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'company_id', $this->integer());
        $this->createIndex('idx-company_id', 'order', 'company_id');
        $this->addForeignKey('fk-company_id', 'order', 'company_id', 'company', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-company_id', 'order');
        $this->dropIndex('idx-company_id', 'order');
        $this->dropColumn('order', 'company_id');
    }
}
