<?php

namespace frontend\modules\api\models;

use Yii;

class Tag extends \common\models\Tag
{
    public function fields()
    {
        return ['id', 'title'];
    }

    public function extraFields()
    {
        return [];
    }
}
