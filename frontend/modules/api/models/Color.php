<?php

namespace frontend\modules\api\models;

/**
 * This is the model class for table "color".
 *
 * @property int $id
 * @property string|null $color
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Color extends \common\models\Color
{
    public function fields()
    {
        return [
            'id',
            'value',
            'name',
        ];
    }

    public function extraFields()
    {
        return [

        ];
    }
}