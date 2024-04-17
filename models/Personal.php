<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal".
 *
 * @property int $id
 * @property string $name
 *
 * @property Cashbox[] $cashboxes
 * @property Cashbox[] $cashboxes0
 * @property Contracts[] $contracts
 * @property Contracts[] $contracts0
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal';
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
     * Gets query for [[Cashboxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashboxes()
    {
        return $this->hasMany(Cashbox::class, ['personal_id' => 'id']);
    }

    /**
     * Gets query for [[Contracts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::class, ['personal_id' => 'id']);
    }
}
