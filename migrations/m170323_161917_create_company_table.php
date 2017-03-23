<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m170323_161917_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'slug' => $this->string(30)->notNull()->unique(),
            'description' => $this->text(),
            'img' => $this->string(150)->notNull(),
            'up_date' => $this->integer(11)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
