<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%color}}`.
 */
class m221005_133120_create_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%color}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(),
            'name' => $this->string()->null(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%color}}');
    }
}
