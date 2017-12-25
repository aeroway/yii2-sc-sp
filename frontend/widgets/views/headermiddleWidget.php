<?php
	use yii\helpers\Html;
?>
<div class="header-middle"><!--header-middle-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo pull-left">
					<a href="<?= Yii::$app->homeUrl ?>"><img src="<?= Yii::$app->homeUrl ?>images/home/logo.png" alt="" /></a>
				</div>
				<!-- <div class="btn-group pull-right">
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
							USA
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">Canada</a></li>
							<li><a href="#">UK</a></li>
						</ul>
					</div>
					
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
							DOLLAR
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">Canadian Dollar</a></li>
							<li><a href="#">Pound</a></li>
						</ul>
					</div>
				</div> -->
			</div>
			<div class="col-sm-8">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
                        <?php
                            echo Html::beginForm(['/site/logout'], 'post', array('id'=>'logout'));
                        ?>
						<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
						<li><a href="<?=Yii::$app->homeUrl?>shoppingcart/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
						<li><a href="<?=Yii::$app->homeUrl?>shoppingcart/listcart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                    <?php
						if(!Yii::$app->user->isGuest)
						{
                    ?>
							<li><a href="#"><i class="fa fa-user"></i> Account (<?= Yii::$app->user->identity->username ?>)</a></li>
							<li>
                                <a href="javascript:void(0)" onClick="javascript: document.getElementById('logout').submit();">
                                <i class="fa fa-user"></i> Logout</a>
							</li>
					<?php
                        } else {
					?>
							<li><a href="<?=Yii::$app->homeUrl?>site/login"><i class="fa fa-lock"></i> Login</a></li>
					<?php } echo Html::endForm(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header-middle-->