<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170323_162204_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'role' => $this->string(5),
            'name' => $this->string(25)->notNull(),
            'surname' => $this->string(25)->notNull(),
            'patronymic' => $this->string(25),
            'email' => $this->string(25)->notNull()->unique(),
            'phone' => $this->string(25)->notNull(),
            'password' => $this->string()->notNull(),
            'add_date' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
