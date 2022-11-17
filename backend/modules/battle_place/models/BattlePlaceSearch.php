<?php

namespace backend\modules\battle_place\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\battle_place\models\BattlePlace;

/**
 * BattlePlaceSearch represents the model behind the search form of `backend\modules\battle_place\models\BattlePlace`.
 */
class BattlePlaceSearch extends BattlePlace
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'scale'], 'integer'],
            [['bounds', 'name', 'created_at', 'updated_at', 'start_date', 'end_date'], 'safe'],
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
        $query = BattlePlace::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'scale' => $this->scale,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'bounds', $this->bounds])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
