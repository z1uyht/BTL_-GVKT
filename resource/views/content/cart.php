<?php
$eloquent = new Eloquent();
if (isset($_SESSION['SSCF_login_id'])) {
    $productListCart = $eloquent->loadCartInfo($_SESSION['SSCF_login_id']);
} else {
    $productListCart = [];
    echo '<script>
            window.location.href = "login.php";
        </script>';
}


$priceSub = 0;
if ($productListCart != [])
    foreach ($productListCart as $eachProduct) {
        $productImageItem = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
        $priceSub += $eachProduct['product_price'] * $eachProduct['quantity'];
    }
?>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow">Trang chủ</a>
                <span></span> <a href="product-category.php" rel="nofollow">Sản phẩm</a>
                <span></span> Giỏ hàng
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng</th>
                                    <th class="d-none" scope="col">quantity remain</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="load_product_detail">
                                <!-- load data from load cart detail -->
                            </tbody>
                        </table>
                    </div>
                    <div class="divider center_icon mt-50 mb-50"></div>
                    <div class="row mb-50">

                        <div class="col-lg-6 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals" id="load_price_cart">
                                <!-- load price cart -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>