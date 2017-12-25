<?php
    //use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use common\libs\Cart;
    $docso = new Cart();
?>
<div class="breadcrumbs">
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Оформление заказа</li>
    </ol>
</div><!--/breadcrums-->
<?php $form = ActiveForm::begin(); ?>
<div class="shopper-informations">
    <div class="row">
        <div class="col-sm-3">
            <div class="shopper-info">
                <p>Контакты покупателя</p>
                <?= $form->field($model, 'user_name')->textInput(['autofocus' => false, 'placeholder' => "Full Name*"])->label(false) ?>
                <?= $form->field($model, 'address')->textInput(['placeholder' => "Address*"])->label(false) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => "Email*"])->label(false) ?>
                <?= $form->field($model, 'mobile')->textInput(['placeholder' => "Mobile Phone*"])->label(false) ?>
                <div class="form-group field-order-deliver_id order-message">
                    <label for="check"><input type="checkbox" name="check" id="check" onchange="changeItem(this.id)"> Адрес доставки тот же</label>
                </div>
                <div class="form-group field-order-request">
                <?= Html::submitButton($model->isNewRecord ? 'CheckOut' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5 clearfix">
            <div class="bill-to">
                <p>Доставить по адресу</p>
                <div class="form-one">
                    <?= $form->field($model, 'user_ship')->textInput(['placeholder' => "Full Name*"])->label(false) ?>
                    <?= $form->field($model, 'address_ship')->textInput(['placeholder' => "Address*"])->label(false) ?>
                    <?= $form->field($model, 'email_ship')->textInput(['placeholder' => "Email*"])->label(false) ?>
                    <?= $form->field($model, 'mobile_ship')->textInput(['placeholder' => "Mobile Phone"])->label(false) ?>
                </div>
                <div class="form-two">
                    <?= $form->field($model, 'payment_id')->dropDownList($payment, ['prompt' => '- Варианты оплаты -'])->label(false) ?>
                    <?= $form->field($model, 'deliver_id')->dropDownList($delivery, ['prompt' => '- Способы доставки -'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="order-message">
                <p>Shipping Order</p>
                <?= $form->field($model, 'request')->textarea(['placeholder' => "Notes about your order, Special Notes for Delivery", 'rows' => '16'])->label(false) ?>
            </div>	
        </div>					
    </div>
</div>
<?php ActiveForm::end(); ?>
<div class="review-payment">
    <h2>Review & Payment</h2>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $subtotal = 0;
            if(!empty($cart))
            {
                foreach($cart as $key => $value)
                {
            ?>
            <tr>
                <td class="cart_product">
                    <img id="img_<?= $key; ?>" src="<?= $value["img"] ?>" alt="<?= $value["name"] ?>" width="100">
                </td>
                <td class="cart_description">
                    <h4><a id="txtPro_<?= $key; ?>" href="<?= Yii::$app->homeUrl . 'product/detail/' . $key ?>"><?= $value["name"] ?></a></h4>
                    <p>Web ID: <?= $key ?></p>
                </td>
                <td class="cart_price">
                    <p id="txtPrice_<?= $key; ?>">₽<?= number_format($value["price"], 0, "", " ") ?></p>
                </td>
                <td class="cart_quantity">
                    <p><?= $value["pro_sl"] ?></p>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">₽<?= number_format($value["pro_sl"] * $value["price"], 0, "", " ");
                        $subtotal += $value["pro_sl"] * $value["price"];
                    ?></p>
                </td>
            </tr>
            <?php } 
            }?>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">
                    <table class="table table-condensed total-result">
                        <tr>
                            <td>Сбор</td>
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
        </tbody>
    </table>
</div>
<script>
    function changeItem(){
        if($('#check').prop('checked')){
            $("#order-user_ship").val($("#order-user_name").val());
            $("#order-email_ship").val($("#order-email").val());
            $("#order-mobile_ship").val($("#order-mobile").val());
            $("#order-address_ship").val($("#order-address").val());
        } else {
            $("#order-user_ship").val("");
            $("#order-email_ship").val("");
            $("#order-mobile_ship").val("");
            $("#order-address_ship").val("");
        }
    }
</script>