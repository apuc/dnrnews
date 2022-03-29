<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_comment_dislike}}`.
 */
class m220328_145559_create_user_comment_dislike_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_comment_dislike}}', [
            'id' => $this->primaryKey(),
            'user_id' =>  $this->integer(),
            'comment_id' =>  $this->integer(),
        ]);
        $this->addForeignKey(
            'user_comment_dislike_user_fk',
            'user_comment_dislike',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_comment_dislike_comment_fk',
            'user_comment_dislike',
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
        $this->dropForeignKey('user_comment_dislike_user_fk', 'user_comment_dislike');
        $this->dropForeignKey('user_comment_dislike_comment_fk', 'user_comment_dislike');
        $this->dropTable('{{%user_comment_dislike}}');
    }
}
