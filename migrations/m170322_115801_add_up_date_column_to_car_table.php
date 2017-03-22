<?php

use yii\db\Migration;

/**
 * Handles adding up_date to table `car`.
 */
class m170322_115801_add_up_date_column_to_car_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('car', 'up_date', 'INTEGER(11) NOT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('car', 'up_date');
    }
}
