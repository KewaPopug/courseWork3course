<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Immovables;

/**
 * ImmovablesSearch represents the model behind the search form of `app\models\Immovables`.
 */
class ImmovablesSearch extends Immovables
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'immovables_types_id', 'regions_id', 'client_owner_id', 'square'], 'integer'],
            [['address', 'description', 'status'], 'safe'],
            [['price'], 'number'],
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
        $query = Immovables::find();

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
            'immovables_types_id' => $this->immovables_types_id,
            'regions_id' => $this->regions_id,
            'client_owner_id' => $this->client_owner_id,
            'price' => $this->price,
            'square' => $this->square,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
