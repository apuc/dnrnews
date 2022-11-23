<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%upper_point_at_battle_place}}`.
 */
class m221123_113546_add_bounds_column_to_upper_point_at_battle_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('battle_place', 'upper_point',  $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('battle_place', 'upper_point');
    }
}
