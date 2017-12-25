<?php
    namespace frontend\widgets;

    use yii\base\Widget;
    use yii\helpers\Html;
    use frontend\models\Product;

    class recommendedWidget extends Widget
    {
        public $message;

        public function init()
        {
            parent::init();
        }

        public function run()
        {
            $product = new Product();
            $product = $product->getDataProduct();

            return $this->render('recommendedWidget', ['data' => $product]);
        }
    }
?>