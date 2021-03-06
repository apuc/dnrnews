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
            [['status', 'created_at', 'updated_at', 'views'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png, webp, jpeg'],
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
            'title' => '??????????????????',
            'photo' => '????????',
            'news_body' => '?????????? ??????????????',
            'status' => '????????????',
            'created_at' => '???????? ????????????????',
            'updated_at' => '???????? ??????????????????',
            'views' => '??????????????????'
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
}
