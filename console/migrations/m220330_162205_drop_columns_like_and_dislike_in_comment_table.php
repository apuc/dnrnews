<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%columns_like_and_dislike_in_comment}}`.
 */
class m220330_162205_drop_columns_like_and_dislike_in_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('comment', 'like');
        $this->dropColumn('comment', 'dislike');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('comment', 'like', $this->integer());
        $this->addColumn('comment', 'dislike', $this->integer());
    }
}
