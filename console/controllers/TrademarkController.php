<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\models\Trademark;

class TrademarkController extends Controller
{
    private $page = 1;
    private $pagenew = 1;
    private $allActiveCategory;

    public function actionIndex()
    {
        $client = new \SimaLand\API\Rest\Client(
            [
                'login' => Yii::$app->params['login'],
                'password' => Yii::$app->params['password'],
            ]
        );

        while($this->pagenew >= $this->page)
        {
            $response = $client->get('trademark',
                [
                    'page' => $this->page,
                    'is_not_empty' => '1',
                ]
            );

            $body = json_decode($response->getBody(), true);

            foreach($body['items'] as $k1 => $v1)
            {
                $data = Trademark::find()->where('id=:id', ['id' => $body['items'][$k1]['id']])->one();
                $this->allActiveCategory[] = $body['items'][$k1]['id'];

                if(empty($data))
                    $data = new Trademark;

                foreach($v1 as $k2 => $v2)
                    $data->$k2 = $v2;

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

        //Деактивация
        $allActiveCategory = implode(', ', $this->allActiveCategory);
        $models = Trademark::find()->where("id NOT IN ($allActiveCategory)")->all();

        foreach($models as $model)
        {
            $model->status = 0;
            $model->update(false);
        }

        $this->tmc();
    }

    private function tmc()
    {
        $mTrademark = Trademark::find()
            ->select(['trademark.id', 'trademark.name', 'ct' => 'COUNT(*)'])
            ->innerJoin('product', 'product.trademark_id = trademark.id')
            ->where(['and', ['trademark.status' => 1], ['is not', 'trademark.photo', null], ['product.is_disabled' => 0]])
            ->groupBy('trademark.name')
            ->asArray()
            ->all();

        foreach($mTrademark as $key => $value)
            Trademark::updateAll(['count' => $value["ct"]], ['id' => $value["id"]]);
    }
}
?>