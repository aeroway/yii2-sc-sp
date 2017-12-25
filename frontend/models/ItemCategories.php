<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "item_categories".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $category_id
 */
class ItemCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'category_id'], 'required'],
            [['item_id', 'category_id'], 'integer'],
            [['item_id', 'category_id'], 'unique', 'targetAttribute' => ['item_id', 'category_id'], 'message' => 'The combination of Item ID and Category ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'category_id' => 'Category ID',
        ];
    }
}
