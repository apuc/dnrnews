<?php

namespace frontend\modules\api\models;

class EventType extends \common\models\EventType
{

    public function afterFind()
    {
        $this->icon = '/uploads/news-image/icon/' . $this->icon;
        parent::afterFind();
    }

}