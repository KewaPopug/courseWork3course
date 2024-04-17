<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "immovables_operations".
 *
 * @property int $id
 * @property string $name
 *
 * @property Contracts[] $contracts
 * @property Contracts[] $contracts0
 */
class ImmovablesOperations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'immovables_operations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 254],
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
        ];
    }

    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::class, ['immovables_operations_id' => 'id']);
    }

    /**
     * Gets query for [[Contracts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts0()
    {
        return $this->hasMany(Contracts::class, ['immovables_operations_id' => 'id']);
    }
}
