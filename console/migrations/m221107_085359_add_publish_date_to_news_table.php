<?php

use yii\db\Migration;

/**
 * Class m221107_085359_add_publish_date_to_news_table
 */
class m221107_085359_add_publish_date_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'published_date', $this->integer()->notNull());

        $newsArr = \common\models\News::find()->all();
        foreach ($newsArr as $news) {
            if (empty($news->published_date)) {
                $news->published_date = $news->created_at;
                $news->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'published_date');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221107_085359_add_publish_date_to_news_table cannot be reverted.\n";

        return false;
    }
    */
}
