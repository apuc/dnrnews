<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_tag}}`.
 */
class m220327_090957_create_news_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news_tag}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'news_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'news_tag_tag',
            'news_tag',
            'tag_id',
            'tag',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'news_tag_news',
            'news_tag',
            'news_id',
            'news',
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
        $this->dropForeignKey('news_tag_tag', 'news_tag');
        $this->dropForeignKey('news_tag_news', 'news_tag');
        $this->dropTable('{{%news_tag}}');
    }
}
