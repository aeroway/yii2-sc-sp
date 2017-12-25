<?php
    use frontend\models\Product;
    use yii\widgets\Pjax;

    Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
    <?php
        $i = 0;
        foreach($dataCat as $key => $value)
        {
            $i++;
            $class = '';
            if($i == 1)
            {
                $class = 'class="active"';
            }
    ?>
            <li <?= $class; ?>><a href="#<?= $value["id"] ?>" data-toggle="tab"><?= $value["name"] ?></a></li>
    <?php
        }
    ?>
        </ul>
    </div>
    <div class="tab-content">
<?php
    $j = 0;
    foreach($dataCat as $key => $value)
    {
        $j++;
        $class = '';
        if($j == 1)
        {
            $class = 'active';
        }
?>
        <div class="tab-pane fade <?= $class; ?> in" id="<?= $value["id"] ?>" >
    <?php
        $product = new Product();
        $product = $product->getDataTabProduct($value["id"]);
        foreach($product as $valuepro)
        {
    ?>
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="<?= Yii::$app->homeUrl ?>product/detail/<?= $valuepro["id"] ?>#p0">
                                <img id="img_<?= $valuepro["id"] ?>" src='<?= $valuepro["img"] ?>' alt='<?= $valuepro["name"] ?>' />
                            </a>
                            <h2 id="txtPrice_<?= $valuepro["id"] ?>">₽<?= number_format($valuepro["price"], 0, "", " ") ?></h2>
                            <p id="txtPro_<?= $valuepro["id"] ?>"><?= $valuepro["name"] ?></p>
                            <a href="javascript:void(0)" onclick="addCart(<?= $valuepro["id"] ?>)" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>
        </div>
<?php
    }
?>
    </div>
</div><!--/category-tab-->
<?php
Pjax::end();
?>