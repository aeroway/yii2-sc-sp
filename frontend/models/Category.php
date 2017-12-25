<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $cat_icon
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => '{attribute} не может быть пустым'],
            [['parent_id', 'status'], 'integer'],
            [['name', 'cat_icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cat ID',
            'name' => 'Cat Name',
            'parent_id' => 'Parent ID',
            'cat_icon' => 'Cat Icon',
            'status' => 'Status',
        ];
    }

    public $dataArr, $dataStr;

    public function getCategoryBy($parentid = 0)
    {
        $data = Category::find()
            ->where('parent_id=:parentid AND status = 1', ['parentid' => $parentid])
            ->asArray()
            ->all();

        return $data;
    }

    public function getDataTabHomePage($parentid = 0, $limit = 4)
    {
        $data = Yii::$app->db->createCommand("SELECT DISTINCT category_id FROM product AS r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM product)) AS id) AS r2 WHERE r1.id >= r2.id and r1.is_disabled != 1 ORDER BY r1.id ASC LIMIT $limit")->queryAll();
        $locConArray = array();

        foreach($data as $k1 => $v1)
        {
            foreach($v1 as $key => $value)
            {
                if(!empty($value))
                    $locConArray["$k1"] = $value;
            }
        }

        $comma_separated = implode(", ", $locConArray);
        //$data = Yii::$app->db->createCommand("SELECT * FROM category WHERE status = 1 AND parent_id != $parentid AND id IN ($comma_separated) LIMIT $limit")->queryAll();

        $data = Category::find()
            ->where(['and', ['status' => '1'], ['!=', 'parent_id', $parentid], 'id IN ('.$comma_separated.')'])
            ->limit($limit)
            ->asArray()
            ->all();

        return $data;
    }

    public function getAllCategoryParent($parent = 0, $level = "-")
    {
        $data = Category::find()
            ->where('parent_id = :parent', ['parent' => $parent])
            ->asArray()
            ->all();

        $level .= "-";

        if($parent == 0)
        {
            $level = "";
        }

        foreach($data as $key => $value)
        {
            $this->dataArr[$value['id']] = $level . $value['name'];
            self::getAllCategoryParent($value['id'], $level);
        }

        return $this->dataArr;
    }

    //Меню категории
    public function getCategoryParent($parent)
    {
        $result = Category::find()
            ->where('parent_id = :parent AND status = 1', ['parent' => $parent])
            ->orderBy('name ASC')
            ->asArray()
            ->all();

        $this->dataStr .= "<ul>";
        foreach ($result as $key => $value)
        {
            if(!$value["is_leaf"] == 1)
            {
                $str = '<span class="badge pull-left"><a href="javascript:void(0)" onclick="lists(\'' . $value["id"] . '\')"><i class="fa fa-plus sm"></i></a></span>';
                $this->dataStr .= '<li>' . $str . '<p><a href="javascript:void(0)" onclick="lists(\'' . $value["id"] . '\')">' . $value["name"] . '</a></p>';
                $this->dataStr .= '<div id="lists' . $value["id"] . '"></div></li>';
            }
            else
            {
                $str = '<span class="badge pull-left"><i class="fa fa-minus sm"></i></span>';
                $this->dataStr .= '<li>' . $str . '<p><a href="' . Yii::$app->homeUrl . 'product/listbycat/' . 
                    $value["id"] . '#p0">' . $value["name"] . '</a></p>';
            }


        }
        $this->dataStr .= "</ul>";

        return $this->dataStr;
    }

    public function getCategoryByName($id)
    {
        $data = Category::find()
            ->where('category_id=:category_id', ['category_id' => $id])
            ->asArray()
            ->one();

        return $data["name"];
    }
}
