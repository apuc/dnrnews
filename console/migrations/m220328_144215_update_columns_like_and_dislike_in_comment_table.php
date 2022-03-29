<?php

use yii\db\Migration;

/**
 * Class m220328_144215_update_columns_like_and_dislike_in_comment_table
 */
class m220328_144215_update_columns_like_and_dislike_in_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('comment', 'like', $this->integer()->defaultValue(0));
        $this->alterColumn('comment', 'dislike', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('comment', 'like', $this->integer());
        $this->alterColumn('comment', 'dislike', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220328_144215_update_columns_like_and_dislike_in_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
