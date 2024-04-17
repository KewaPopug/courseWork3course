<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "immovables_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property Immovables[] $immovables
 * @property Immovables[] $immovables0
 */
class ImmovablesTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'immovables_types';
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
     * Gets query for [[Immovables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovables()
    {
        return $this->hasMany(Immovables::class, ['immovables_types_id' => 'id']);
    }

    /**
     * Gets query for [[Immovables0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImmovables0()
    {
        return $this->hasMany(Immovables::class, ['immovables_types_id' => 'id']);
    }
}
