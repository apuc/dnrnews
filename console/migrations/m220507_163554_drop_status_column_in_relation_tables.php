<?php

use yii\db\Migration;

/**
 * Class m220507_163554_drop_status_column_in_relation_tables
 */
class m220507_163554_drop_status_column_in_relation_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('category_news', 'status');
        $this->dropColumn('category_tag', 'status');
        $this->dropColumn('news_tag', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('category_news', 'status', $this->smallInteger()->defaultValue(10),);
        $this->addColumn('category_tag', 'status', $this->smallInteger()->defaultValue(10),);
        $this->addColumn('news_tag', 'status', $this->smallInteger()->defaultValue(10),);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220507_163554_drop_status_column_in_relation_tables cannot be reverted.\n";

        return false;
    }
    */
}
