<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170320_152307_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'type' => "ENUM('user', 'admin', 'guest')",
            'name' => $this->string(25)->notNull(),
            'email' => $this->string(25)->notNull()->unique(),
            'surname' => $this->string(25)->notNull(),
            'patronymic' => $this->string(25),
            'phone' => $this->string(25)->notNull(),
            'password' => $this->string()->notNull(),
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
