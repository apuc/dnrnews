<?php

use yii\db\Migration;

/**
 * Class m220401_134245_update_foreign_keys_in_comment_table
 */
class m220401_134245_update_foreign_keys_in_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('comment_user', 'comment');
        $this->dropForeignKey('comment_news', 'comment');

        $this->addForeignKey(
            'comment_user',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'comment_news',
            'comment',
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
        $this->dropForeignKey('comment_user', 'comment');
        $this->dropForeignKey('comment_news', 'comment');

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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220401_134245_update_foreign_keys_in_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
