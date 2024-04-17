<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "contracts".
 *
 * @property int $number
 * @property int $immovables_id
 * @property int $client_id
 * @property int $personal_id
 * @property int $immovables_operations_id
 * @property string|null $description
 * @property int $contract_period
 * @property string $date_cashbox
 *
 * @property Cashbox[] $cashboxes
 * @property Cashbox[] $cashboxes0
 * @property Clients $client
 * @property Clients $client0
 * @property Immovables $immovables
 * @property Immovables $immovables0
 * @property ImmovablesOperations $immovablesOperations
 * @property ImmovablesOperations $immovablesOperations0
 * @property Personal $personal
 * @property Personal $personal0
 */
class Contracts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['immovables_id', 'client_id', 'personal_id', 'immovables_operations_id', 'contract_period', 'date_cashbox'], 'required'],
            [['immovables_id', 'client_id', 'personal_id', 'immovables_operations_id', 'contract_period'], 'integer'],
            [['description'], 'string'],
            [['date_cashbox'], 'safe'],
            [['immovables_operations_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImmovablesOperations::class, 'targetAttribute' => ['immovables_operations_id' => 'id']],
            [['immovables_operations_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImmovablesOperations::class, 'targetAttribute' => ['immovables_operations_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['personal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::class, 'targetAttribute' => ['personal_id' => 'id']],
            [['personal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::class, 'targetAttribute' => ['personal_id' => 'id']],
            [['immovables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immovables::class, 'targetAttribute' => ['immovables_id' => 'id']],
            [['immovables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Immovables::class, 'targetAttribute' => ['immovables_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => 'Number',
            'immovables_id' => 'Immovables ID',
            'client_id' => 'Client ID',
            'personal_id' => 'Personal ID',
            'immovables_operations_id' => 'Immovables Operations ID',
            'description' => 'Description',
            'contract_period' => 'Contract Period',
            'date_cashbox' => 'Date Cashbox',
        ];
    }

    /**
     * Gets query for [[Cashboxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashboxes()
    {
        return $this->hasMany(Cashbox::class, ['contract_id' => 'number']);
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Immovables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovables()
    {
        return $this->hasOne(Immovables::class, ['id' => 'immovables_id']);
    }

    /**
     * Gets query for [[ImmovablesOperations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovablesOperations()
    {
        return $this->hasOne(ImmovablesOperations::class, ['id' => 'immovables_operations_id']);
    }

    /**
     * Gets query for [[Personal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonal()
    {
        return $this->hasOne(Personal::class, ['id' => 'personal_id']);
    }

    public function procedureContractByPersonal(int $personalId): \yii\data\SqlDataProvider
    {
        $sql = "contract_by_personal :personal_id";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'params' => [':personal_id' => $personalId],
            'pagination' => false,
            'sort' => false,
        ]);
    }

    public function procedureGeneralSumByImmovablesOperation(int $immovablesOperationId): \yii\data\SqlDataProvider
    {
        $sql = "general_sum_by_immovables_operation :immovables_operation_id";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'params' => [':immovables_operation_id' => $immovablesOperationId],
            'pagination' => false,
            'sort' => false,
        ]);
    }

    public function getClientByImmovablesOperations(int $immovablesOperationId): \yii\data\SqlDataProvider
    {
        $sql = "SELECT cli.name as client, io.name as imovables_operation
                FROM contracts con
                iNNER JOIN clients cli ON cli.id = con.client_id
                iNNER JOIN immovables_operations io ON io.id = con.immovables_operations_id
                WHERE immovables_operations_id = :immovables_operations_id 
        ";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'params' => [':immovables_operations_id' => $immovablesOperationId],
            'pagination' => false,
            'sort' => false,
        ]);
    }
}
