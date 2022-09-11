<?php

use yii\db\Migration;

/**
 * Class m220910_144805_add_column_coordinates_to_news_table
 */
class m220910_144805_add_column_coordinates_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'coordinates', $this->string(255));
        $this->addColumn('news', 'event_type_id', $this->integer(11));
        $this->addColumn('news', 'is_map_event', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'coordinates');
        $this->dropColumn('news', 'event_type_id');
        $this->dropColumn('news', 'is_map_event');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220910_144805_add_column_coordinates_to_news_table cannot be reverted.\n";

        return false;
    }
    */
}
