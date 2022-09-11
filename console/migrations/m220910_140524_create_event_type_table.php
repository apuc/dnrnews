<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_type}}`.
 */
class m220910_140524_create_event_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'icon' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->defaultValue(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_type}}');
    }
}
