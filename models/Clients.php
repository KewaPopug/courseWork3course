<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string $phone
 * @property string $attribute
 *
 * @property Cashbox[] $cashboxes
 * @property Cashbox[] $cashboxes0
 * @property Contracts[] $contracts
 * @property Contracts[] $contracts0
 * @property Immovables[] $immovables
 * @property Immovables[] $immovables0
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'attribute'], 'required'],
            [['name', 'address'], 'string', 'max' => 254],
            [['phone'], 'string', 'max' => 20],
            [['attribute'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'attribute' => 'Attribute',
        ];
    }

    /**
     * Gets query for [[Cashboxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashboxes()
    {
        return $this->hasMany(Cashbox::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::class, ['client_id' => 'id']);
    }

    /**
     * Gets query for [[Immovables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovables()
    {
        return $this->hasMany(Immovables::class, ['client_owner_id' => 'id']);
    }


    public function procedureLegalClients()
    {
        $sql = "legal_client";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
            'sort' => false,
        ]);
    }
}
