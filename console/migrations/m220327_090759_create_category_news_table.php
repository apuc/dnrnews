<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_news}}`.
 */
class m220327_090759_create_category_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_news}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer(),
            'category_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'category_news_news',
            'category_news',
            'news_id',
            'news',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'category_news_category',
            'category_news',
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
        $this->dropForeignKey('category_news_news', 'category_news');
        $this->dropForeignKey('category_news_category', 'category_news');
        $this->dropTable('{{%category_news}}');
    }
}
