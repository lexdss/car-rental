<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170323_162100_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'slug' => $this->string(30)->notNull()->unique(),
            'previewContent' => $this->text(),
            'content' => $this->text(),
            'img' => $this->string(),
            'upDate' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
