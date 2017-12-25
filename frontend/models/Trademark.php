<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trademark".
 *
 * @property integer $id
 * @property string $sid
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string $photo
 * @property string $count
 */
class Trademark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trademark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'name'], 'required'],
            [['count'], 'integer'],
            [['description'], 'string'],
            [['sid'], 'string', 'max' => 20],
            [['name', 'slug', 'photo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'name' => 'Name',
            'description' => 'Description',
            'slug' => 'Slug',
            'photo' => 'Photo',
            'count' => 'count',
        ];
    }
}
