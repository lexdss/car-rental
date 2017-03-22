<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m170320_143847_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'code' => $this->string(30)->notNull()->unique(),
            'description' => $this->text(),
            'img' => $this->string(150)->notNull()
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
