<?php

use yii\db\Migration;

/**
 * Class m220416_173657_add_column_views_to_news_table
 */
class m220416_173657_add_column_views_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'views', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220416_173657_add_column_views_to_news_table cannot be reverted.\n";

        return false;
    }
    */
}
