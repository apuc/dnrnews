<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_comment_like}}`.
 */
class m220328_145553_create_user_comment_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_comment_like}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'comment_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'user_comment_like_user_fk',
            'user_comment_like',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_comment_like_comment_fk',
            'user_comment_like',
            'comment_id',
            'comment',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_comment_like_user_fk', 'user_comment_like');
        $this->dropForeignKey('user_comment_like_comment_fk', 'user_comment_like');
        $this->dropTable('{{%user_comment_like}}');
    }
}
