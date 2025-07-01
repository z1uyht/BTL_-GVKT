<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'cart');
$view->loadContent('include', 'tail');

?>

<script>
    $(document).ready(function() {
        $('#load_product_detail').load("app/Handle/loadCartDetail.php");
        $('#load_price_cart').load("app/Handle/loadPriceCart.php");
    });
</script>