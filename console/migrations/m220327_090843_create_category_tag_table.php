<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_tag}}`.
 */
class m220327_090843_create_category_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_tag}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'category_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'category_tag_tag',
            'category_tag',
            'tag_id',
            'tag',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'category_tag_category',
            'category_tag',
            'category_id',
            'category',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('category_tag_tag', 'category_tag');
        $this->dropForeignKey('category_tag_category', 'category_tag');
        $this->dropTable('{{%category_tag}}');
    }
}
