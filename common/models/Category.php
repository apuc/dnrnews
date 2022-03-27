<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoryNews[] $categoryNews
 * @property CategoryTag[] $categoryTags
 */
class Category extends \common\models\User
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CategoryNews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNews()
    {
        return $this->hasMany(CategoryNews::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[CategoryTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTags()
    {
        return $this->hasMany(CategoryTag::className(), ['category_id' => 'id']);
    }
}
