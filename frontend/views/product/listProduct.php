<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<!--features_items-->
<div id="features" class="features_items">
	<?php //<h2 class="title text-center"><span class="horline">Популярные</span></h2> ?>
<?php
foreach($product as $key => $value)
{
?>
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
                    <a href="<?= Yii::$app->homeUrl ?>product/detail/<?= $value["id"] ?>">
                        <img id="img_<?= $value["id"] ?>" src="<?= $value["img"] ?>" alt="<?= $value["name"] ?>" />
                    </a>
                        <h2 id="txtPrice_<?= $value["id"] ?>">₽<?= number_format($value["price"], 0, "", " ") ?></h2>
                        <p><a href="<?= Yii::$app->homeUrl ?>product/detail/<?= $value["id"] ?>" id="txtPro_<?= $value["id"] ?>"><?= $value["name"] ?></a></p>
                        <a href="javascript::void(0)" class="btn btn-default add-to-cart" onclick="addCart(<?= $value["id"] ?>)">
                            <i class="fa fa-shopping-cart"></i>В корзину
                        </a>
				</div>
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<li><a href=""><i class="fa fa-plus-square"></i>В желания</a></li>
					<?php //<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li> ?>
				</ul>
			</div>
		</div>
	</div>
<?php
}
?>
</div><!--features_items-->
<?= LinkPager::widget([
		'pagination' => $pages,
		'firstPageLabel' => '|<',
		'lastPageLabel' => '>|',
		'prevPageLabel' => '<',
		'nextPageLabel' => '>',
		'maxButtonCount' => '5',
        'hideOnSinglePage' => true,
	]);

Pjax::end();
?>
