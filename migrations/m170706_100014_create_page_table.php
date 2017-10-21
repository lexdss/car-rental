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
            'slug' => $this->string(30)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'type' => $this->string(50)->notNull(),
            'previewContent' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'title' => $this->string(),
            'keywords' => $this->string(),
            'description' => $this->string(),
            'upDate' => $this->integer()->notNull()
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
