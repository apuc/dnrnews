<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m220327_091020_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'news_id' => $this->integer(),
            'comment_body' => $this->string(500),
            'like' => $this->integer(),
            'dislike' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'comment_user',
            'comment',
            'user_id',
            'user',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'comment_news',
            'comment',
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
        $this->dropForeignKey('comment_user', 'comment');
        $this->dropForeignKey('comment_news', 'comment');
        $this->dropTable('{{%comment}}');
    }
}
