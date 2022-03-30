<?php

namespace frontend\modules\api\models;

class Comment extends \common\models\Comment
{
    public function fields()
    {
        return ['id', 'comment_body', 'username'];
    }

    public function extraFields()
    {
        return [
            'dislike' => function () {
                $this->getUserCommentDislikeCount();
            },
            'like' => function () {
                $this->getUserCommentLikeCount();
            }
        ];
    }
}
