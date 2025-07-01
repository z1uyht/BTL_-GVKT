<?php
//fetch all categories hot (product best sell)
$subCategoryList = $eloquent->selectData(['id', 'subcategory_name'], 'subcategories', ['subcategory_status' => 'Active', 'is_delete' => '0'], [], [], [], 0, ['START' => 0, 'END' => 7]);

//fetch 3 items product add new
$newProductList = $eloquent->selectData(['*'], 'products', ['product_type' => 'Active', 'is_delete' => '0'], [], [], [], ['DESC' => 'id'], ['START' => 0, 'END' => 3]);

//list color
$productColorList = $eloquent->selectData(['*'], 'products_sc', ['is_delete' => '0'], [], [], ["product_color"], ['DESC' => 'id'], ['START' => 0, 'END' => 100]);

?>
<div class="col-lg-3 primary-sidebar sticky-sidebar">
    <div class="widget-category mb-30">
        <h5 class="section-title style-1 mb-30 wow fadeIn animated text-brand">DANH MỤC NỔI BẬT</h5>
        <ul class="categories">
            <?php
            foreach ($subCategoryList as $eachSubCategory) {
                echo '<li><a href="product-category.php?subCategoryId=' . $eachSubCategory['id'] . '">' . $eachSubCategory['subcategory_name'] . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <!-- Product sidebar Widget -->
    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
        <h5 class="section-title style-1 mb-10 wow fadeIn animated text-brand">SẢN PHẨM MỚI</h5>
        <?php
        foreach ($newProductList as $eachNewProduct) {
            $newProductImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachNewProduct['product_master_image'];
        ?>
        <div class="single-post clearfix">
            <div class="image">
                <img src="<?= $newProductImage ?>" alt="#">
            </div>
            <div class="content pt-10">
                <h5><a
                        href="product-detail.php?id=<?= $eachNewProduct['id'] ?>"><?php echo $eachNewProduct['product_name'] ?></a>
                </h5>
                <p class="price mb-0 mt-5">
                    <?= number_format($eachNewProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></p>
                <!-- <div class="product-rate">
                        <div class="product-rating" style="width:90%"></div>
                    </div> -->
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
const priceList = document.getElementsByClassName("check_price_custom");
var price = 0;
for (let i = 0; i < priceList.length; i++) {
    priceList[i].addEventListener("click", function() {
        for (let j = 0; j < priceList.length; j++) {
            if (j != i) {
                priceList[j].checked = false;
            }
        }
    })
}

const colorList = document.getElementsByClassName("check_color_custom");
for (let i = 0; i < colorList.length; i++) {
    colorList[i].addEventListener("click", function() {
        for (let j = 0; j < colorList.length; j++) {
            if (j != i) {
                colorList[j].checked = false;
            }
        }
    })
}
</script>