<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $news_id
 * @property string|null $comment_body
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property News $news
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time(),// new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'news_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'news_id', 'comment_body'], 'required'],
            [['comment_body'], 'string', 'max' => 500],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'news_id' => 'Новость',
            'comment_body' => 'Комментарий',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUsername()
    {
        return $this->user->username;
    }

    public function getUserCommentLike()
    {
        return $this->hasMany(UserCommentLike::className(), ['comment_id' => 'id']);
    }

    public function getUserCommentDislike()
    {
        return $this->hasMany(UserCommentDislike::className(), ['comment_id' => 'id']);
    }

    public function getUserCommentLikeCount()
    {
        return $this->getUserCommentLike()->count();
    }

    public function getUserCommentDislikeCount()
    {
        return $this->getUserCommentDislike()->count();
    }
}
