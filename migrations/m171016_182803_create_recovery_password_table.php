<?php

use yii\db\Migration;

/**
 * Handles the creation of table `recovery_password`.
 */
class m171016_182803_create_recovery_password_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('recovery_password', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'userHash' => $this->string()->notNull()
        ]);

        $this->createIndex('idx-recovery_password-userId', 'recovery_password', 'userId');
        $this->addForeignKey('fk-recovery_password-userId', 'recovery_password', 'userId', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-recovery_password-userId', 'recovery_password');
        $this->dropIndex('idx-recovery_password-userId', 'recovery_password');
        $this->dropTable('recovery_password');
    }
}
