<?php

namespace frontend\modules\api\models;

class Comment extends \common\models\Comment
{
    public $user_like;
    public $user_dislike;

    public function fields(): array
    {
        return ['id', 'comment_body', 'username'];
    }

    public function extraFields(): array
    {
        return [
            'dislike' => function () {
                return (int)$this->getUserCommentDislikeCount();
            },
            'like' => function () {
                return (int)$this->getUserCommentLikeCount();
            },
            'user_like' ,
            'user_dislike'
        ];
    }
}
