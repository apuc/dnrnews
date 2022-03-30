<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%columns_like_in_news}}`.
 */
class m220330_162523_drop_columns_like_in_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('news', 'like');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('news', 'like', $this->integer());
    }
}
