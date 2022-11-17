<?php

namespace frontend\modules\api\models;

/**
 * This is the model class for table "bounds".
 *
 * @property int $id
 * @property string|null $bounds
 * @property string|null $name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class BattlePlace extends \common\models\BattlePlace
{
    public function fields()
    {
        return [
            'name',
            'bounds',
            'scale',
            'start_date',
            'end_date'
        ];
    }

    public function extraFields()
    {
        return [];
    }
}