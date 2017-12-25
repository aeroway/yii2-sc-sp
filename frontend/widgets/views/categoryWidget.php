<?php
    use frontend\models\Category;
    use yii\widgets\Pjax;

    Pjax::begin(['timeout' => 10000, 'clientOptions' => ['container' => '#p0']]);
?>
<!--<h2><span class="horline">Каталог</span></h2>-->
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
<?php
foreach($dataParent as $key => $value) 
{
    $dataSub = new Category();
    $dataSubr = $dataSub->getCategoryBy($value["id"]);
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian" href="#<?= str_replace(" ", "", $value["name"]) ?>">
                <?php
                if($dataSubr)
                {
                ?>
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                <?php
                }
                ?>
                <?= $value["name"] ?>
                </a>
            </h4>
        </div>
    <?php
    if($dataSubr)
    {
    ?>
        <div id="<?= str_replace(" ", "", $value["name"]) ?>" class="panel-collapse collapse">
            <div class="panel-body">
                <?= $dataSub->getCategoryParent($value["id"]); ?>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
<?php
}
?>
</div><!--/category-products-->
<?php
Pjax::end();
?>