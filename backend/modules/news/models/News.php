<?php

namespace backend\modules\news\models;

use Yii;
use yii\helpers\ArrayHelper;

class News extends \common\models\News
{

    public $_category;
    public $_tag;

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->_category) {
            CategoryNews::deleteAll(['news_id' => $this->id]);
            foreach ($this->_category as $categoryId) {
                $categ = new CategoryNews();
                $categ->category_id = $categoryId;
                $categ->news_id = $this->id;
                $categ->save();
            }
        }

        if ($this->_tag) {
            foreach ($this->_tag as $tagId) {
                $tag = new NewsTag();
                $tag->news_id = $this->id;
                $tag->tag_id = $tagId;
                $tag->save();
            }
        }
    }

    public function afterFind()
    {
        $this->_tag = ArrayHelper::getColumn($this->tags, 'id');
        $this->_category = ArrayHelper::getColumn($this->category, 'id');

        parent::afterFind();
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['_category', '_tag'], 'safe'];
        return $rules;
    }

}
