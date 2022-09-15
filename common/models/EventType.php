<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "event_type".
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property int|null $status
 */
class EventType extends \yii\db\ActiveRecord
{
    public $image;

    const STATUS_PASSIVE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'icon' => 'Icon',
            'status' => 'Status',
        ];
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
                @unlink(Yii::getAlias('@newsImage') . '/' . $this->getOldAttribute('icon'));
            }

            $image = UploadedFile::getInstance($this, 'image');
            $imageName = md5(date("Y-m-d H:i:s"));
            $pathImage = Yii::getAlias('@newsImage')
                . '/icon/'
                . $imageName
                . '.'
                . $image->getExtension();

            $this->icon = $imageName . '.' . $image->getExtension();
            $image->saveAs($pathImage);

        } else {
            $this->icon = $this->getOldAttribute('icon');
        }
        return true;
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}
