<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "full_view_table_with_relations_immovables".
 *
 * @property int $id
 * @property string $immovables_types
 * @property string $regions
 * @property string $clients
 * @property string $address
 * @property float $price
 * @property int $square
 * @property string|null $description
 * @property string|null $status
 */
class FullViewTableWithRelationsImmovables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'full_view_table_with_relations_immovables';
    }

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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'immovables_types' => 'Immovables Types',
            'regions' => 'Regions',
            'clients' => 'Clients',
            'address' => 'Address',
            'price' => 'Price',
            'square' => 'Square',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
