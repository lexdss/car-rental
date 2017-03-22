<?php

use yii\db\Migration;

/**
 * Handles adding up_date to table `company`.
 */
class m170322_111242_add_up_date_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'up_date', 'INTEGER(11) NOT NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'up_date');
    }
}
