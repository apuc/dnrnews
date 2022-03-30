<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
class Comment extends \common\models\User
{
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
            'user_id' => 'User ID',
            'news_id' => 'News ID',
            'comment_body' => 'Comment Body',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
        return $this->hasMany(UserCommentLike::className(), ['news_id' => 'id']);
    }

    public function getUserCommentDislike()
    {
        return $this->hasMany(UserCommentDislike::className(), ['news_id' => 'id']);
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
