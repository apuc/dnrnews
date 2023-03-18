<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

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
 * @property string|null $photo
 * @property string|null $description
 *
 * @property News[] $news
 */
class BattlePlace extends \yii\db\ActiveRecord
{
    public $image;

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
            [['start_date', 'end_date', 'upper_point', 'lower_point', 'name', 'scale', 'description'], 'required'],
            [['created_at', 'updated_at', 'start_date', 'end_date'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png, webp, jpeg'],
            [['scale'], 'integer'],
            [['upper_point', 'lower_point', 'name', 'description', 'photo'], 'string', 'max' => 255],
            [['upper_point', 'lower_point'], function ($attribute) {
                if (!preg_match('/\d{2}\.\d+,\d{2}\.\d+/m', $this->getAttribute($attribute))) {
                    $this->addError($attribute,'You entered an invalid dot format.');
                }
            }, 'skipOnError' => true],
        ];
    }

    public function afterDelete()
    {
        if (is_file(Yii::getAlias('@battlePlaceImage') . '/' . $this->photo)) {
            unlink(Yii::getAlias('@battlePlaceImage') . '/' . $this->photo);
        }

        parent::afterDelete();
    }

    public function getImageurl()
    {
        return \Yii::$app->request->BaseUrl . '/photo' . '/' . $this->photo;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (UploadedFile::getInstance($this, 'image')) {
            if (!$insert) {
                @unlink(Yii::getAlias('@battlePlaceImage') . '/' . $this->getOldAttribute('photo'));
            }

            $image = UploadedFile::getInstance($this, 'image');
            $imageName = md5(date("Y-m-d H:i:s"));
            $pathImage = Yii::getAlias('@battlePlaceImage')
                . '/'
                . $imageName
                . '.'
                . $image->getExtension();

            $this->photo = $imageName . '.' . $image->getExtension();
            $image->saveAs($pathImage);

        } else {
            $this->photo = $this->getOldAttribute('photo');
        }
        return true;
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
            'photo' => 'Фото',
            'description' => 'Описание',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::class, ['battle_place_id' => 'id']);
    }
}
