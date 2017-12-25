<?php
    //use common\libs\Cart;
    //$docso = new Cart();
?>
<div id="listCart">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?= Yii::$app->homeUrl ?>">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td class="delete"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $subtotal = 0;
                if($cart)
                {
                    foreach($cart as $key => $value)
                    {
                ?>
                <tr>
                    <td class="cart_product">
                        <a href=""><img id="img_<?= $key; ?>" src="<?= $value["img"] /* Yii::$app->homeUrl . substr($value["img"], strpos($value["img"], "items/"))*/ ?>" alt='<?= $value["name"] ?>' width="100"></a>
                    </td>
                    <td class="cart_description">
                        <h4><a id="txtPro_<?= $key; ?>" href="<?= Yii::$app->homeUrl . 'product/detail/' . $key ?>"><?= $value["name"] ?></a></h4>
                        <p>Web ID: <?= $key ?></p>
                    </td>
                    <td class="cart_price">
                        <p id="txtPrice_<?= $key; ?>">₽<?= number_format($value["price"], 0, "", " ") ?></p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="javascript:void(0)" onclick="itemUp(<?= $key ?>)"> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity_<?= $key ?>" id="quantity_<?= $key ?>" value="<?= $value["pro_sl"] ?>" autocomplete="off" size="2">
                            <a class="cart_quantity_down" href="javascript:void(0)" onclick="itemDown(<?= $key ?>)"> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">₽<?= number_format($value["pro_sl"] * $value["price"], 0, "", "");
                            $subtotal += $value["pro_sl"] * $value["price"];
                        ?></p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="javascript:void(0)" onclick="deleteItem(<?= $key ?>)"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php } 
                }?>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="3">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Орг. сбор</td>
                                <td>0%</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Доставка</td>
                                <td>Бесплатно</td>										
                            </tr>
                            <tr>
                                <td>Всего</td>
                                <td><span>₽<?= number_format($subtotal, 0, "", " "); ?></span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!--<tr>
                    <td colspan="6">Прописью : <strong><?php //$docso->convert_number_to_words($subtotal); ?></strong></td>
                </tr>-->
            </tbody>
        </table>
    </div>
</div>