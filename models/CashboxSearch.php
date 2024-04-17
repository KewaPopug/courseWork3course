<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cashbox;

/**
 * CashboxSearch represents the model behind the search form of `app\models\Cashbox`.
 */
class CashboxSearch extends Cashbox
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number', 'personal_id', 'client_id', 'contract_id'], 'integer'],
            [['date_cashbox'], 'safe'],
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
        $query = Cashbox::find();

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
            'number' => $this->number,
            'personal_id' => $this->personal_id,
            'client_id' => $this->client_id,
            'date_cashbox' => $this->date_cashbox,
            'price' => $this->price,
            'contract_id' => $this->contract_id,
        ]);

        return $dataProvider;
    }
}
