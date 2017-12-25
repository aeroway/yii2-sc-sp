<?php
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<!--product-details-->
<div class="product-details">
    <div class="col-sm-5">
        <div class="view-product">
            <div id="zoom">
                <div id="img_<?= $data["id"] ?>">
                    <img src="<?= str_replace('/140.jpg', '/700-nw.jpg', $data["img"]) ?>" alt='<?= $data['name']?>'>
                </div>
            </div>
            <h3>ZOOM</h3>
        </div>

        <div id="similar-product" class="carousel slide" data-ride="carousel">

              <!-- Wrapper for slides -->

<?php
$arrayLinks;

if(isset($data["photoIndexes"]))
{
    echo '<div class="carousel-inner">';

    $pieces = explode(",", $data["photoIndexes"]);
    foreach($pieces as $v)
    {
        $arrayLinks[] = "<a href='javascript:void(0)' onclick='detailimg(" . $data["id"] . "," . $v . ")'><img src='https://cdn.sima-land.ru/items/" . $data["id"] . "/" . $v . "/140.jpg' alt='" . $data["name"] . "'></a>";
    }

    $arrayLinks = array_chunk($arrayLinks, 3);

    foreach($arrayLinks as $k1 => $v1)
    {
        if($k1 == 0)
            echo '<div class="item active"><span>';
        else
            echo '<div class="item"><span>';

        foreach($v1 as $k2 => $v2)
            echo $v2;

        echo '</span></div>';
    }
    echo '</div>';
} else {
    $pieces = 0;
}

?>

              <!-- Controls -->
              <a class="left item-control<?= count($pieces) <= 3 ? ' disabled' : '' ?>" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left<?= count($pieces) <= 3 ? ' disabled' : '' ?>"></i>
              </a>
              <a class="right item-control<?= count($pieces) <= 3 ? ' disabled' : '' ?>" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right<?= count($pieces) <= 3 ? ' disabled' : '' ?>"></i>
              </a>
        </div>
    </div>
    <div class="col-sm-7">
        <!--/product-information-->
        <div class="product-information">
            <?php
            if($data["ecommerce_variant"] == 'new')
                echo '<img src="' . Yii::$app->homeUrl . 'images/product-details/new.jpg" class="newarrival">';
            if($data["ecommerce_variant"] == 'sale')
                echo '<img src="' . Yii::$app->homeUrl . 'images/home/sale.png" class="new">';
            ?>
            <h2 id="txtPro_<?= $data["id"] ?>"><?= $data['name']?></h2>
            <p>Артикул: <?= $data['id']?></p>
            <?php //<img src="images/product-details/rating.png" alt="" /> ?>
            <span>
                <span id="txtPrice_<?= $data["id"] ?>">₽<?= number_format($data['price'], 0, "", " ") ?></span>
                <label>Количество:</label>
                <input type="text" value="<?= $data["min_qty"] ?>" name="number" id="number" />
                <button type="button" class="btn btn-fefault cart" onclick="addCart(<?= $data["id"] ?>)">
                    <i class="fa fa-shopping-cart"></i>
                    В корзину
                </button>
            </span>
            <p><b>В наличии: </b> 
            <?php
            if($data["balance"] === '' or $data["balance"] === NULL )
                echo 'много';
            elseif($data["balance"] === 0)
                echo 'нет';
            else
                echo $data["balance"] . ' ' . $data["balancePluralNameFormat"];
            ?>
            </p>
            <?php
            $trademark = ((new \yii\db\Query())->select(['name'])->from('trademark')->where(['id' => $data["trademark_id"]])->one())["name"];

            if($trademark)
                echo '<p><b>Торговая марка:</b> ' . $trademark . '</p>';
            ?>

            <?php //<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> ?>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->
<?php
Pjax::end();
?>