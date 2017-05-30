<?php

use yii\db\Migration;

/**
 * Handles the creation of table `car`.
 */
class m170323_162104_create_car_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('car', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'category_id' => $this->integer(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull()->unique(),
            'year' => $this->integer(4)->notNull(),
            'speed' => $this->integer(3)->notNull(),
            'engine' => $this->string(25)->notNull(),
            'color' => $this->string(25)->notNull(),
            'transmission' => $this->string(25)->notNull(),
            'privod' => $this->string(25)->notNull(),
            'description' => $this->text(),
            'price' => $this->integer(6)->notNull(),
            'discount_1' => $this->integer(2),
            'discount_2' => $this->integer(2),
            'img' => $this->string()->notNull(),
            'up_date' => $this->integer(11)->notNull()
        ]);

        $this->createIndex('idx-car-company_id', 'car', 'company_id');

        $this->addForeignKey(
            'fk-car-company_id',
            'car',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-car-category_id', 'car', 'category_id');

        $this->addForeignKey(
            'fk-car-category_id',
            'car',
            'category_id',
            'category',
            'id',
            'SET NULL'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-car-category_id', 'car');
        $this->dropIndex('idx-car-category_id', 'car');

        $this->dropForeignKey('fk-car-company_id', 'car');
        $this->dropIndex('idx-car-company_id', 'car');

        $this->dropTable('car');
    }
}
