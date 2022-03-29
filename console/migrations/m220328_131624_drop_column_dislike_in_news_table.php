<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%column_dislike_in_news}}`.
 */
class m220328_131624_drop_column_dislike_in_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('news', 'dislike');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('news', 'dislike', $this->integer()->null());
    }
}
