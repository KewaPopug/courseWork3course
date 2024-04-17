<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "full_view_table_immovables".
 *
 * @property int $id
 * @property int $immovables_types_id
 * @property int $regions_id
 * @property int $client_owner_id
 * @property string $address
 * @property float $price
 * @property int $square
 * @property string|null $description
 * @property string|null $status
 */
class FullViewTableImmovables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'full_view_table_immovables';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['immovables_types_id', 'regions_id', 'client_owner_id', 'address', 'price', 'square'], 'required'],
            [['immovables_types_id', 'regions_id', 'client_owner_id', 'square'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['address'], 'string', 'max' => 254],
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
            'immovables_types_id' => 'Immovables Types ID',
            'regions_id' => 'Regions ID',
            'client_owner_id' => 'Client Owner ID',
            'address' => 'Address',
            'price' => 'Price',
            'square' => 'Square',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
