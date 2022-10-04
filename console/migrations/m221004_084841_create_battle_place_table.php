<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%battle_place}}`.
 */
class m221004_084841_create_battle_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%battle_place}}', [
            'id' => $this->primaryKey(),
            'bounds' => $this->string(),
            'name' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%battle_place}}');
    }
}
