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
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'img' => $this->string(),
            'up_date' => $this->integer()->notNull()
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
