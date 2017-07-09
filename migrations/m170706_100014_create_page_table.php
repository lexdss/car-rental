<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page`.
 */
class m170706_100014_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(25)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'up_date' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('page');
    }
}
