<?php

namespace frontend\modules\api\models;

use Yii;

class Comment extends \common\models\Comment
{
    public function fields()
    {
        return ['id', 'comment_body','like', 'dislike', 'username'];
    }

    public function extraFields()
    {
        return [];
    }
}
