<?php

namespace frontend\modules\api\models;

/**
 *
 * @property int $id
 * @property string|null $upper_point
 * @property string|null $lower_point
 * @property string|null $name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class BattlePlace extends \common\models\BattlePlace
{
    public function fields()
    {
        return [
            'id',
            'name',
            'bounds' => function () {
                return $this->getCoordinate();
            },
            'scale',
            'start_date',
            'end_date',
            'photo' => function () {
                return $this->getPhotoLink();
            },
            'description'
        ];
    }

    public function getPhotoLink()
    {
        if (empty($this->photo)) {
            return 'N/A';
        }
        return '/uploads/battle_place_photo/' . $this->photo;
    }

    private function getCoordinate()
    {
        return "[[$this->lower_point], [$this->upper_point]]";
    }

    public function extraFields()
    {
        return [];
    }
}