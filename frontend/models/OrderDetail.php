<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property integer $order_detail_id
 * @property integer $order_id
 * @property integer $pro_id
 * @property integer $pro_price
 * @property integer $pro_amount
 * @property integer $status
 * @property integer $created_at
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'pro_id', 'pro_price', 'pro_amount', 'status', 'created_at'], 'required'],
            [['order_detail_id', 'order_id', 'pro_id', 'pro_price', 'pro_amount', 'status', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_id' => 'Order Detail ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Pro ID',
            'pro_price' => 'Pro Price',
            'pro_amount' => 'Pro Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
