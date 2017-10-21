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
    public function safeUp()
    {
        $this->createTable('car', [
            'id' => $this->primaryKey(),
            'companyId' => $this->integer()->notNull(),
            'categoryId' => $this->integer()->notNull(),
            'name' => $this->string(30)->notNull(),
            'slug' => $this->string(30)->notNull()->unique(),
            'title' => $this->string(),
            'keywords' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'price' => $this->integer(6)->notNull(),
            'doors' => $this->integer(1)->notNull(),
            'passengers' => $this->integer(2)->notNull(),
            'conditioner' => $this->integer(1)->notNull(),
            'transmission' => $this->string()->notNull(),
            'engine' => $this->string()->notNull(),
            'speed' => $this->integer(3)->notNull(),
            'fuelConsumption' => $this->integer(2),
            'drive' => $this->string()->notNull(),
            'trunkVolume' => $this->integer(3),
            'bodyStyle' => $this->string()->notNull(),
            'color' => $this->string(),
            'year' => $this->integer(4)->notNull(),
            'img' => $this->string()->notNull(),
            'upDate' => $this->integer(11)->notNull()
        ]);

        $this->createIndex('idx-car-companyId', 'car', 'companyId');
        $this->addForeignKey(
            'fk-car-companyId',
            'car',
            'companyId',
            'company',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-car-categoryId', 'car', 'categoryId');
        $this->addForeignKey(
            'fk-car-categoryId',
            'car',
            'categoryId',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-car-categoryId', 'car');
        $this->dropIndex('idx-car-categoryId', 'car');

        $this->dropForeignKey('fk-car-companyId', 'car');
        $this->dropIndex('idx-car-companyId', 'car');

        $this->dropTable('car');
    }
}
