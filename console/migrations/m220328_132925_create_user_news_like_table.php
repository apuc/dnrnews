<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_like}}`.
 */
class m220328_132925_create_user_news_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_news_like}}', [
            'id' => $this->primaryKey(),
            'user_id' =>  $this->integer(),
            'news_id' =>  $this->integer(),
        ]);
        $this->addForeignKey(
            'user_news_like_user_fk',
            'user_news_like',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_news_like_news_fk',
            'user_news_like',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_news_like_user_fk', 'user_news_like');
        $this->dropForeignKey('user_news_like_news_fk', 'user_news_like');
        $this->dropTable('{{%user_news_like}}');
    }
}
