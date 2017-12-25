<?php
	namespace frontend\widgets;

	use yii\base\Widget;
	use yii\helpers\Html;
    use frontend\models\Product;
    use frontend\models\Trademark;

	class brandsproductsWidget extends Widget
	{
		public $message;

		public function init()
		{
			parent::init();
		}

		public function run()
		{
			$data = new Product();
			$dataTrademark = $data->getTrademarkName();

			return $this->render('brandsproductsWidget',
                [
                    'dataTrademark' => $dataTrademark,
                ]
            );
		}
	}
?>