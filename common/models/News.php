<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $photo
 * @property string|null $news_body
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryNews[] $categoryNews
 * @property Comment[] $comments
 * @property NewsTag[] $newsTags
 */
class News extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_body'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
//            [['created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'photo' => 'Фото',
            'news_body' => 'Текст новости',
            'status' => 'Статус',
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

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->via('categoryNews');
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('newsTags');
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

    public function getUserNewsLike()
    {
        return $this->hasMany(UserNewsLike::className(), ['news_id' => 'id']);
    }

    public function getLikesCount()
    {
        return $this->getUserNewsLike()->count();
    }

    public function getCommentsCount()
    {
        return $this->getComments()->count();
    }
}
