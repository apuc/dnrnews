<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
 * @property int|null $views
 * @property int $published_date
 *
 * @property CategoryNews[] $categoryNews
 * @property Comment[] $comments
 * @property NewsTag[] $newsTags
 */
class News extends ActiveRecord
{
    public $image;

    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 10;

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
            [['status', 'created_at', 'updated_at', 'views', 'event_type_id', 'is_map_event'], 'integer'],
            [['title', 'coordinates'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, gif, png, webp, jpeg'],
            ['published_date', 'integer'], //проверка
            ['published_date', 'default', 'value' => time()], //значение по умолчанию
            ['dateTime', 'date', 'format' => 'php:d.m.Y'], //формат модели с которой будем работать
        ];
    }

    public function afterDelete()
    {
        if (is_file(Yii::getAlias('@newsImage') . '/' . $this->photo)) {
            unlink(Yii::getAlias('@newsImage') . '/' . $this->photo);
        }

        parent::afterDelete();
    }

    public function getImageurl()
    {
        return \Yii::$app->request->BaseUrl . '/photo' . '/' . $this->photo;
    }


    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (UploadedFile::getInstance($this, 'image')) {
            if (!$insert) {
                @unlink(Yii::getAlias('@newsImage') . '/' . $this->getOldAttribute('photo'));
            }

            $image = UploadedFile::getInstance($this, 'image');
            $imageName = md5(date("Y-m-d H:i:s"));
            $pathImage = Yii::getAlias('@newsImage')
                . '/'
                . $imageName
                . '.'
                . $image->getExtension();

            $this->photo = $imageName . '.' . $image->getExtension();
            $image->saveAs($pathImage);

        } else {
            $this->photo = $this->getOldAttribute('photo');
        }
        return true;
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
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'views' => 'Просмотры',
            'coordinates' => 'Координаты на карте',
            'event_type_id' => 'Тип события',
            'is_map_event' => 'Добавить на карту',
            'published_date' => 'Дата публикации',
            'dateTime' => 'Дата публикации',
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

    public function getNewsTag()
    {
        return $this->hasMany(NewsTag::className(), ['news_id' => 'id']);
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

    public function getDateTime()
    {
        return $this->published_date ? date('d.m.Y', $this->published_date) : '';
    }

    public function setDateTime($date)
    {
        $this->published_date = $date ? strtotime($date) : null;
    }
}
