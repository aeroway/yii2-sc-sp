<?php
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<div id="features" class="features_items"><!--features_items-->
    <!--<h2 class="title text-center"><span class="horline">Популярные</span></h2>-->
    <?php foreach($data as $key => $value) { ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img id="img_<?= $value["parent_item_id"] ?>" src="<?= $value["img"] /* Yii::$app->homeUrl . substr($value["img"], strpos($value["img"], "items/")) */ ?>" alt="<?= $value["name"] ?>" />
                    <h2 id="txtPrice_<?= $value["parent_item_id"] ?>">₽<?= number_format($value["price"], 0, "", " ") ?></h2>
                    <p><span id="txtPro_<?= $value["parent_item_id"] ?>"><?= $value["name"] ?></span></p>
                    <a href="javascript:void(0)" class="btn btn-default add-to-cart" onclick="addCart(<?= $value["parent_item_id"] ?>,1)">
                        <i class="fa fa-shopping-cart"></i>В корзину
                    </a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>₽<?= number_format($value["price"], 0, "", " ") ?></h2>
                        <p><?= $value["name"] ?></p>
                        <a href="javascript:void(0)" class="btn btn-default add-to-cart" onclick="addCart(<?= $value["parent_item_id"] ?>)">
                            <i class="fa fa-shopping-cart"></i>В корзину
                        </a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <!--<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
</div><!--features_items-->
<?php Pjax::end(); ?>