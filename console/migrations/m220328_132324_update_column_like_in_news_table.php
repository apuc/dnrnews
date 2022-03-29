<?php

use yii\db\Migration;

/**
 * Class m220328_132324_update_column_like_in_news_table
 */
class m220328_132324_update_column_like_in_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('news', 'like', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('news', 'like', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220328_132324_update_column_like_in_news_table cannot be reverted.\n";

        return false;
    }
    */
}
