<?php
    namespace frontend\widgets;

    use yii\base\Widget;
    use yii\helpers\Html;
    use frontend\models\Category;

    class categorytabWidget extends Widget
    {
        public $message;

        public function init()
        {
            parent::init();
        }

        public function run()
        {
            $dataCat = new Category();
            $dataCat = $dataCat->getDataTabHomePage();

            return $this->render('categorytabWidget', ['dataCat' => $dataCat]);
        }
    }
?>