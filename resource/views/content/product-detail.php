<?php
$control = new Controller;
$eloquent = new Eloquent;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if(is_numeric($id) == false) {
        echo "<script>window.location.href = 'not-found.php';</script>";
    }
}

//fetch all products
$columnName = ['*'];
$tableName = 'products';
$whereValue = [
    'id' => $id,
    'is_delete' => '0',
    'product_type' => 'Active'
];
$productList = $eloquent->selectData($columnName, $tableName, $whereValue);
if ($productList != []) {
    $imageMaster = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_master_image'];
    $imageOne = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_one'];
    $imageTwo = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_two'];
    $imageThree = $GLOBALS['PRODUCT_DIRECTORY'] . $productList[0]['product_image_three'];

    $percentDiscountPrice = ($productList[0]['virtual_price'] - $productList[0]['product_price']) / $productList[0]['virtual_price'];
} else {
    echo "<script>window.location.href = 'not-found.php';</script>";
}

//san pham co lien quan
$getCategoryID = $eloquent->selectData(['category_id'], 'products', ['id' => $id]);
$whereValue = ['category_id' => $getCategoryID[0]['category_id']];
$relateProductList = $eloquent->selectData(['*'], 'products', $whereValue, [], [], [], 0, ['START' => 0, 'END' => 8]);
//print_r($relateProductList);

//fetch all color for product id
$colorProductList = $eloquent->selectData(['product_color'], 'products_sc', ['product_id' => $id, 'is_delete' => '0'], [], [], ['product_color' => 'product_color']);
//print_r($colorProductList);

//fetch all size for product id
$productSizeList = $eloquent->selectData(['product_size'], 'products_sc', ['product_id' => $id, 'is_delete' => '0'], [], [], ['product_size' => 'product_size']);
//print_r($productSizeList);


?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <a href="product-category.php"><span></span>Sản phẩm</a>
                <span></span><?= $productList[0]['product_name'] ?>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageMaster ?>" alt="product image">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageOne ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageTwo ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                        <figure class="border-radius-10">
                                            <img src="<?= $imageThree ?>" alt="product image" class="w-100 h-100">
                                        </figure>
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-10">
                                        <div><img src="<?= $imageMaster ?>" alt="product image"></div>
                                        <div><img src="<?= $imageOne ?>" alt="product image"></div>
                                        <div><img src="<?= $imageTwo ?>" alt="product image"></div>
                                        <div><img src="<?= $imageThree ?>" alt="product image"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <form class="detail-info">
                                    <h2 class="title-detail"><?= $productList[0]['product_name'] ?></h2>
                                    <input type="hidden" name="" id="productId" value="<?= $id ?>">
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Brands: <a href="product.php">HTH</a></span>
                                        </div>
                                
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <ins><span class="text-brand"><?= number_format($productList[0]['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <ins><span class="old-price font-md ml-15"><?= number_format($productList[0]['virtual_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span></ins>
                                            <span class="save-price font-md color3 ml-15 text-success">
                                                (giảm giá <?= round($percentDiscountPrice * 100, 0) ?>%)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p><?= $productList[0]['product_summary'] ?></p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i>Bảo hành sản phẩm 1 năm</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i>Thanh toán Cod</li>
                                        </ul>
                                    </div>
                                    <div class="attr-detail attr-color mb-15">
                                        <strong class="mr-10">Màu</strong>
                                        <ul class="list-filter color-filter">
                                            <?php
                                            foreach ($colorProductList as $eachColor) {
                                                echo '<li class=""><a class="choice-color" data-color="' . $eachColor['product_color'] . '"><span class="product-color-' . $eachColor['product_color'] . '"></span></a></li>';
                                            }
                                            ?>
                                        </ul>
                                        <input type="hidden" name="val-color" id="val-color">
                                    </div>
                                    <div class="attr-detail attr-size">
                                        <strong class="mr-10">Size</strong>
                                        <ul class="list-filter size-filter font-small load-size">
                                            <?php
                                            foreach ($productSizeList as $eachSize) {
                                                echo '<li class="mr-5"><a class="choice-size" data-size="' . $eachSize['product_size'] . '">' . $eachSize['product_size'] . '</a></li>';
                                            }
                                            ?>
                                        </ul>
                                        <input type="hidden" name="val-size" id="val-size">
                                    </div>
                                    <div class="attr-detail mt-10">
                                        <span class="in-stock text-success load-status-quantity">
                                            <input type="hidden" id="idProductsSC" value="0">
                                            <p class="text-danger">Bạn chưa chọn size hoặc màu 🤔</p>
                                        </span>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                    <div class="detail-extralink">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart add_to_cart">Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">Tags: <a href="#" rel="tag"><?= $productList[0]['product_tags'] ?></a></li>
                                    </ul>
                                </form>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">MÔ TẢ</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p><?= $productList[0]['product_details'] ?></p>
                                        <h4 class="mt-30">Hướng dẫn chọn size</h4>
                                        <hr class="wp-block-separator is-style-wide">
                                        <p>Size M: 50-57kg / Cao 1m53 – 1m68</p>
                                        <p>Size L: 58-64kg / Cao 1m160 – 1m70</p>
                                        <p>Size XL: 65-70kg / Cao 1m70 – 1m78</p>
                                        <p>Size XXL: 71-85kg / Cao 1m78 – 1m85</p>
                                        <p>Tùy mỗi người thích body hoặc vừa người thì tăng hoặc giảm 1 size, chỉ số trên là tương đối mặc</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Sản phẩm liên quan</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <?php
                                    if ($relateProductList != [])
                                        foreach ($relateProductList as $eachRelateProduct) {
                                            $imageDefault = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_master_image'];
                                            $iamgeHover = $GLOBALS['PRODUCT_DIRECTORY'] . $eachRelateProduct['product_image_one'];
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0">
                                                            <img class="default-img" src="<?= $imageDefault ?>" alt="">
                                                            <img class="hover-img" src="<?= $iamgeHover ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <!-- <span class="hot">Hot</span> -->
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="product-detail.php?id=<?= $eachRelateProduct['id'] ?>" tabindex="0"><?= $eachRelateProduct['product_name'] ?></a></h2>

                                                    <div class="product-price mt-5">
                                                        <span><?= number_format($eachRelateProduct['product_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                        <span class="old-price"><?= number_format($eachRelateProduct['virtual_price'], 0, ",", ".") . $GLOBALS['CURRENCY'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    else {
                                        echo '<h3>Không có sản phẩm liên quan</h3>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add sitebar -->
            </div>
        </div>
    </section>
</main>