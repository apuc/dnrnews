<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%Battle_place}}`.
 */
class m230318_151254_add_photo_and_description_columns_to_Battle_place_table extends Migration
{
    const TABLE_NAME = 'battle_place';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, 'photo', $this->string());
        $this->addColumn(self::TABLE_NAME, 'description', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE_NAME, 'photo');
        $this->dropColumn(self::TABLE_NAME, 'description');
    }
}
