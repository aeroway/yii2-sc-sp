<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\models\Category;

class CategoryController extends Controller
{
    private $page = 1;
    private $pagenew = 1;
    private $level = 1;
    private $allActiveCategory;

    public function actionIndex()
    {
        $client = new \SimaLand\API\Rest\Client(
            [
                'login' => Yii::$app->params['login'],
                'password' => Yii::$app->params['password'],
            ]
        );

        do
        {
            while($this->pagenew >= $this->page)
            {
                $response = $client->get('category',
                    [
                        'page' => $this->page,
                        'level' => $this->level,
                        'is_not_empty' => '1',
                    ]
                );

                $body = json_decode($response->getBody(), true);

                foreach($body['items'] as $k1 => $v1)
                {
                    $bodyString = substr($body['items'][$k1]['path'], 0, strrpos($body['items'][$k1]['path'], '.'));
                    $pos = strrpos($bodyString, '.');

                    if(strpos($body['items'][$k1]['path'], '.') !== false)
                        $subStr = str_replace(".", "", substr($bodyString, $pos));
                    else
                        $subStr = 0;

                    $data = Category::find()->where('id=:id', ['id' => $body['items'][$k1]['id']])->one();
                    $this->allActiveCategory[] = $body['items'][$k1]['id'];

                    if(empty($data))
                        $data = new Category;

                    $data->parent_id = $subStr;

                    foreach($v1 as $k2 => $v2)
                    {
                        if(
                            $k2 != 'priority' and
                            $k2 != 'priority_home' and
                            $k2 != 'priority_menu' and
                            $k2 != 'is_hidden_in_menu' and
                            $k2 != 'path' and
                            $k2 != 'level' and
                            $k2 != 'type' and
                            $k2 != 'meta_keyword' and
                            $k2 != 'meta_description' and
                            $k2 != 'icon'
                          )
                        {
                            $data->$k2 = $v2;
                        }
                    }

                    $data->status = 1;

                    if(!$data->save())
                    {
                        print_r($data->getErrors());
                        die;
                    }
                }

                if($this->page == 1)
                    $this->pagenew = $body['_meta']['pageCount'];

                $this->page++;
            }

            $this->level++;
            $this->page = 1;
            $this->pagenew = 1;
        } while(count($body['items']) > 0);

        //Выборка неактивных
        $allActiveCategory = implode(', ', $this->allActiveCategory);
        $models = Category::find()->where("id NOT IN ($allActiveCategory)")->all();

        //Деактивация
        foreach($models as $model)
        {
            $model->status = 0;
            $model->update(false);
        }
    }
}
?>