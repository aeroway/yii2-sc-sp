<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Product;
use Yii;
use yii\data\Pagination;

class ProductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actionDetailimg($id, $num)
	{
        return '<img src="https://cdn.sima-land.ru/items/' . $id . '/' . $num . '/700-nw.jpg">';
    }

	public function actionListbycat($id)
	{
		$data = new Product();
		$product = $data->getProductByCat($id);
		$pages = $data->getPagerProduct($data->strCat);
        $pages->pageSizeParam = false;

        if(Yii::$app->request->isAjax)
        {
            return $this->renderPartial('listProduct', [
                'product' => $product, 
                'pages' => $pages,
            ]);
        }
        else
        {
            //return $this->goHome();
            return $this->render('listProduct', [
                'product' => $product, 
                'pages' => $pages,
            ]);
        }
	}

    public function actionDetail($id)
    {
        $data = new Product();
        $product = $data->getInfoProductBy($id);

        if(Yii::$app->request->isAjax)
        {
            return $this->renderPartial('detail', [
                'data' => $product,
            ]);
        }
        else
        {
            //return $this->goHome();
            return $this->render('detail', [
                'data' => $product,
            ]);
        }
    }
}
