<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cashbox".
 *
 * @property int $id
 * @property int $number
 * @property int $personal_id
 * @property int $client_id
 * @property string $date_cashbox
 * @property float $price
 * @property int|null $contract_id
 *
 * @property Clients $client
 * @property Clients $client0
 * @property Contracts $contract
 * @property Contracts $contract0
 * @property Personal $personal
 * @property Personal $personal0
 */
class Cashbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cashbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personal_id', 'client_id', 'date_cashbox', 'price'], 'required'],
            [['number', 'personal_id', 'client_id', 'contract_id'], 'integer'],
            [['date_cashbox'], 'safe'],
            [['price'], 'number'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['personal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::class, 'targetAttribute' => ['personal_id' => 'id']],
            [['personal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::class, 'targetAttribute' => ['personal_id' => 'id']],
            [['contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::class, 'targetAttribute' => ['contract_id' => 'number']],
            [['contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::class, 'targetAttribute' => ['contract_id' => 'number']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'personal_id' => 'Personal ID',
            'client_id' => 'Client ID',
            'date_cashbox' => 'Date Cashbox',
            'price' => 'Price',
            'contract_id' => 'Contract ID',
        ];
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
     * Gets query for [[Contract]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contracts::class, ['number' => 'contract_id']);
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

    /**
     * Gets query for [[Personal]].
     *
     * @return \yii\data\SqlDataProvider
     */
    public function getSummaryEnteredByPersonal()
    {
        $sql = "
        SELECT [personal].[id], [personal].[name], sum(cashbox.price) AS [sum_price]
        FROM [cashbox]
            INNER JOIN [personal] ON cashbox.personal_id = personal.id
        WHERE
            (MONTH(cashbox.date_cashbox) = MONTH(GETDATE()))
        AND
            (YEAR(cashbox.date_cashbox) = YEAR(2023))
        GROUP BY [personal].[id] , [personal].[name]
        ";
        return new \yii\data\SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
            'sort' => false,
        ]);
    }


}
