<div class="brands_products"><!--brands_products-->
    <h2><span class="horline">Бренды</span></h2>
    <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
            <?php
            foreach($dataTrademark as $value)
            {
                echo '<li><a href="#"><span class="pull-right">(' . $value["count"] . ')</span>' . $value["name"] . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div><!--/brands_products-->