<?php

namespace backend\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\news\models\News;

/**
 * NewsSearch represents the model behind the search form of `backend\modules\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'views', 'event_type_id', 'is_map_event', 'published_date', 'battle_place_id'], 'integer'],
            [['title', 'photo', 'news_body', 'coordinates'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'views' => $this->views,
            'event_type_id' => $this->event_type_id,
            'is_map_event' => $this->is_map_event,
            'published_date' => $this->published_date,
            'battle_place_id' => $this->battle_place_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'news_body', $this->news_body])
            ->andFilterWhere(['like', 'coordinates', $this->coordinates]);

        return $dataProvider;
    }
}
