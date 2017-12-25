<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property integer $deli_id
 * @property string $deli_name
 * @property integer $status
 * @property integer $date_created
 * @property integer $date_update
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deli_name', 'date_created', 'date_update'], 'required'],
            [['status', 'date_created', 'date_update'], 'integer'],
            [['deli_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deli_id' => 'Deli ID',
            'deli_name' => 'Deli Name',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
        ];
    }

    public function getAllDelivery()
    {
        $data = Delivery::find()->asArray()->all();

        return $data;
    }
}
