<?php

use yii\db\Migration;

/**
 * Class m220401_133336_update_foreign_keys_in_category_news_table
 */
class m220401_133336_update_foreign_keys_in_category_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('category_news_news', 'category_news');
        $this->dropForeignKey('category_news_category', 'category_news');

        $this->addForeignKey(
            'category_news_news',
            'category_news',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'category_news_category',
            'category_news',
            'category_id',
            'category',
            'id',
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220401_133336_update_foreign_keys_in_category_news_table cannot be reverted.\n";

        return false;
    }
    */
}
