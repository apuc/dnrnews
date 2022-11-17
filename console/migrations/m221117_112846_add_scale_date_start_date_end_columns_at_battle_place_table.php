<?php

use yii\db\Migration;

/**
 * Class m221117_112846_add_scale_date_start_date_end_columns_at_battle_place_table
 */
class m221117_112846_add_scale_date_start_date_end_columns_at_battle_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('battle_place', 'scale', $this->integer(20));
        $this->addColumn('battle_place', 'start_date', $this->dateTime());
        $this->addColumn('battle_place', 'end_date', $this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('battle_place', 'scale');
        $this->dropColumn('battle_place', 'start_date');
        $this->dropColumn('battle_place', 'end_date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221117_112846_add_scale_date_start_date_end_columns_at_battle_place_table cannot be reverted.\n";

        return false;
    }
    */
}
