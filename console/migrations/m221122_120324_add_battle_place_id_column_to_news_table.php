<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 */
class m221122_120324_add_battle_place_id_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'battle_place_id', $this->integer());
        $this->addForeignKey('battle_place_news', 'news', 'battle_place_id', 'battle_place', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('battle_place_news', 'news');
        $this->dropColumn('news', 'battle_place_id');
    }
}
