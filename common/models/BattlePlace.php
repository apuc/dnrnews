<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "battle_place".
 *
 * @property int $id
 * @property string|null $lower_point
 * @property string|null $upper_point
 * @property string|null $name
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $scale
 * @property string|null $start_date
 * @property string|null $end_date
 */
class BattlePlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'battle_place';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'upper_point', 'lower_point', 'name', 'scale'], 'required'],
            [['created_at', 'updated_at', 'start_date', 'end_date'], 'safe'],
            [['scale'], 'integer'],
            [['upper_point', 'lower_point', 'name'], 'string', 'max' => 255],
            [['upper_point', 'lower_point'], function ($attribute) {
                if (!preg_match('/\d{2}\.\d+,\d{2}\.\d+/m', $this->getAttribute($attribute))) {
                    $this->addError($attribute,'You entered an invalid dot format.');
                }
            }, 'skipOnError' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'upper_point' => 'Верхняя точка',
            'lower_point' => 'Нижняя точка',
            'name' => 'Название',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'scale' => 'Масштаб',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
        ];
    }
}
