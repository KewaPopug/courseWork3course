<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contracts;

/**
 * ContractsSearch represents the model behind the search form of `app\models\Contracts`.
 */
class ContractsSearch extends Contracts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'immovables_id', 'client_id', 'personal_id', 'immovables_operations_id', 'contract_period'], 'integer'],
            [['description', 'date_cashbox'], 'safe'],
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
        $query = Contracts::find();

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
            'number' => $this->number,
            'immovables_id' => $this->immovables_id,
            'client_id' => $this->client_id,
            'personal_id' => $this->personal_id,
            'immovables_operations_id' => $this->immovables_operations_id,
            'contract_period' => $this->contract_period,
            'date_cashbox' => $this->date_cashbox,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
