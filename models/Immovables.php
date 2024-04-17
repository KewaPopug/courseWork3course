<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "immovables".
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
 *
 * @property Clients $clientOwner
 * @property Clients $clientOwner0
 * @property Contracts[] $contracts
 * @property Contracts[] $contracts0
 * @property ImmovablesTypes $immovablesTypes
 * @property ImmovablesTypes $immovablesTypes0
 * @property Regions $regions
 * @property Regions $regions0
 */
class Immovables extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'immovables';
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
            [['client_owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_owner_id' => 'id']],
            [['immovables_types_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImmovablesTypes::class, 'targetAttribute' => ['immovables_types_id' => 'id']],
            [['regions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['regions_id' => 'id']],
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

    /**
     * Gets query for [[ClientOwner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientOwner()
    {
        return $this->hasOne(Clients::class, ['id' => 'client_owner_id']);
    }


    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::class, ['immovables_id' => 'id']);
    }


    /**
     * Gets query for [[ImmovablesTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovablesTypes()
    {
        return $this->hasOne(ImmovablesTypes::class, ['id' => 'immovables_types_id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasOne(Regions::class, ['id' => 'regions_id']);
    }

    public function getImmovablesByAddress(string $address): \yii\data\SqlDataProvider
    {
        $sql = "
            SELECT im.id, it.name as it_name, r.name as r_name, c.name as client_name, im.address, im.price, im.square, im.status 
            FROM immovables im 
            INNER JOIN clients c ON c.id = im.client_owner_id
            INNER JOIN regions r ON r.id = im.regions_id
            INNER JOIN immovables_types it ON it.id = im.immovables_types_id
            WHERE im.address like :address
            ";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'params' => [':address' => '%' . $address . '%'],
            'pagination' => false,
            'sort' => false,
        ]);
    }

    public function getImmovablesGroupByRegion(): \yii\data\SqlDataProvider
    {
        $sql = "
            SELECT r.name, COUNT(im.id) as count_immovables 
            FROM immovables im
            INNER JOIN regions r ON r.id = im.regions_id
            GROUP BY r.name
            ";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
            'sort' => false,
        ]);
    }

    public function getImmovablesByStatus(): \yii\data\SqlDataProvider
    {
        $sql = "
            SELECT im.id as im_id, it.name as it_name, r.name as r_name, c.name as client_name, im.address, im.price, im.square, im.status 
            FROM immovables im 
            INNER JOIN clients c ON c.id = im.client_owner_id
            INNER JOIN regions r ON r.id = im.regions_id
            INNER JOIN immovables_types it ON it.id = im.immovables_types_id
            WHERE status = 'Аренда'
            ";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
            'sort' => false,
        ]);
    }

    public function beforeSave($insert)
    {
        $this->status = ($_POST['Immovables']['status'] == '') ? 'Аренда' : $_POST['Immovables']['status'];
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
