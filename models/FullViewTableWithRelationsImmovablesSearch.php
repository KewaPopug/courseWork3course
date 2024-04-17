<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ImmovablesOperations;

/**
 * ImmovablesOperationsSearch represents the model behind the search form of `app\models\ImmovablesOperations`.
 */
class FullViewTableWithRelationsImmovablesSearch extends FullViewTableWithRelationsImmovables
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'immovables_types', 'regions', 'clients', 'address', 'price', 'square'], 'required'],
            [['id', 'square'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['immovables_types', 'regions', 'clients', 'address'], 'string', 'max' => 254],
            [['status'], 'string', 'max' => 22],
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
        $query = FullViewTableWithRelationsImmovables::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
