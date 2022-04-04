<?php

use yii\db\Migration;

/**
 * Class m220401_134528_update_foreign_keys_in_news_tag_table
 */
class m220401_134528_update_foreign_keys_in_news_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('news_tag_tag', 'news_tag');
        $this->dropForeignKey('news_tag_news', 'news_tag');

        $this->addForeignKey(
            'news_tag_tag',
            'news_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'news_tag_news',
            'news_tag',
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
        $this->dropForeignKey('news_tag_tag', 'news_tag');
        $this->dropForeignKey('news_tag_news', 'news_tag');

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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220401_134528_update_foreign_keys_in_news_tag_table cannot be reverted.\n";

        return false;
    }
    */
}
