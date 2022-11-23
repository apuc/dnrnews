<?php

use yii\db\Migration;

/**
 * Class m221123_113503_rename_bounds_column_to_lower_point_at_battle_place_table
 */
class m221123_113503_rename_bounds_column_to_lower_point_at_battle_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('battle_place', 'bounds', 'lower_point');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('battle_place', 'lower_point', 'bounds');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221123_113503_rename_bounds_column_to_lower_point_at_battle_place_table cannot be reverted.\n";

        return false;
    }
    */
}
