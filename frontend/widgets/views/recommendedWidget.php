<?php

use yii\widgets\Pjax;

Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<!--recommended_items-->
<div class="recommended_items">
    <!--<h2 class="title text-center"><span class="horline">Рекомендуемые</span></h2>-->
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
    <?php
        $i = 1;
        $count = count($data);

        foreach($data as $key => $value)
        {
    ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="<?= Yii::$app->homeUrl ?>product/detail/<?= $value["parent_item_id"] ?>#p0">
                                    <img id="img_<?= $value["parent_item_id"] ?>" src="<?= $value["img"] ?>" alt="<?= $value["name"] ?>" />
                                </a>
                                <h2 id="txtPrice_<?= $value["parent_item_id"] ?>">₽<?= number_format($value["price"], 0, "", " ") ?></h2>
                                <p><?= $value["name"] ?></p>
                                <a href="javascript:void(0)" class="btn btn-default add-to-cart" onclick="addCart(<?= $value["parent_item_id"] ?>)">
                                    <i class="fa fa-shopping-cart"></i>В корзину
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
    <?php
            if($i%3==0 && $count > $i)
            {
                echo '</div><div class="item">';
            }
            $i++;
        } 
    ?>
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>            
    </div>
</div>
<!--/recommended_items-->
<?php
Pjax::end();
?>