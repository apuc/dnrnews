<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $photo
 * @property string|null $news_body
 * @property int|null $like
 * @property int|null $dislike
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryNews[] $categoryNews
 * @property Comment[] $comments
 * @property NewsTag[] $newsTags
 */
class News extends \common\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_body'], 'string'],
            [['like', 'dislike', 'status', 'created_at', 'updated_at'], 'integer'],
//            ['like', 'dislike', 'value' => 0],
            [['created_at', 'updated_at'], 'required'],
            [['title', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'news_body' => 'News Body',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CategoryNews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNews()
    {
        return $this->hasMany(CategoryNews::className(), ['news_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['news_id' => 'id']);
    }

    /**
     * Gets query for [[NewsTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsTags()
    {
        return $this->hasMany(NewsTag::className(), ['news_id' => 'id']);
    }
}
