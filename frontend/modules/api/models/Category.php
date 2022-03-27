<?php

namespace frontend\modules\api\models;

use Yii;
use frontend\modules\api\models\Tag;

class Category extends \common\models\Category
{
    public function fields(): array
    {
        return ['id', 'title'];
    }

    public function extraFields(): array
    {
        return ['tags'];
    }

    public function getTags(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->via('categoryTags');
    }
}
