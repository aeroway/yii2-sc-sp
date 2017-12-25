<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $email
 * @property string $mobile
 * @property string $address
 * @property string $user_ship
 * @property string $email_ship
 * @property string $mobile_ship
 * @property string $address_ship
 * @property string $request
 * @property integer $total
 * @property integer $payment_id
 * @property integer $deliver_id
 * @property integer $status
 * @property integer $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'total', 'payment_id', 'deliver_id', 'status', 'created_at'], 'integer'],
            [['user_name', 'email', 'mobile', 'address', 'user_ship', 'email_ship', 'mobile_ship', 'address_ship', 'total', 'payment_id', 'deliver_id', 'created_at'], 'required', 'message' => '{attribute} не может быть пустым'],
            [['request'], 'string'],
            [['user_name', 'email', 'mobile', 'address', 'user_ship', 'email_ship', 'mobile_ship', 'address_ship'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'user_name' => 'Имя покупателя',
            'email' => 'Email',
            'mobile' => 'Телефон',
            'address' => 'Адрес',
            'user_ship' => 'Имя получателя',
            'email_ship' => 'Email получателя',
            'mobile_ship' => 'Телефон получателя',
            'address_ship' => 'Адрес получателя',
            'request' => 'Request',
            'total' => 'Total',
            'payment_id' => 'Оплата',
            'deliver_id' => 'Доставка',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
