<?php

use yii\db\Migration;

/**
 * Class m220404_153329_create_seed_migration
 */
class m220404_153329_create_seed_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->upsert('{{%category}}',[
            'title' => 'Категоря 1',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%category}}',[
            'title' => 'Категоря 2',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%category}}',[
            'title' => 'Категоря 3',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%category}}',[
            'title' => 'Категоря 4',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%category}}',[
            'title' => 'Категоря 5',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);


        $this->upsert('{{%tag}}',[
            'title' => 'Тег 1',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%tag}}',[
            'title' => 'Тег 2',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%tag}}',[
            'title' => 'Тег 3',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%tag}}',[
            'title' => 'Тег 4',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);

        $this->upsert('{{%news}}',[
            'title' => 'Новость 1',
            'news_body' => 'jjkdnvjfdknvjfnvfcnvc vmncbfcbhhhhh 11111111',
            'photo' => 'test_path',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%news}}',[
            'title' => 'Новость 2',
            'news_body' => 'jjkdnvjfdknvjfnvfcnvc vmncbfcbhhhhh 2222222222',
            'photo' => 'test_path',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%news}}',[
            'title' => 'Новость 3',
            'news_body' => 'jjkdnvjfdknvjfnvfcnvc vmncbfcbhhhhh 333333333',
            'photo' => 'test_path',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%news}}',[
            'title' => 'Новость 4',
            'news_body' => 'jjkdnvjfdknvjfnvfcnvc vmncbfcbhhhhh 44444444444444',
            'photo' => 'test_path',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);
        $this->upsert('{{%news}}',[
            'title' => 'Новость 5',
            'news_body' => 'jjkdnvjfdknvjfnvfcnvc vmncbfcbhhhhh 55555555555',
            'photo' => 'test_path',
            'created_at' => 1648368837,
            'updated_at' => 1648368837,
            'status' => 1,
        ]);




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220404_153329_create_seed_migration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220404_153329_create_seed_migration cannot be reverted.\n";

        return false;
    }
    */
}
