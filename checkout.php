<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'checkout');
$view->loadContent('include', 'tail');
?>
<script>
    $('#payment-cod').click(function(e) {
        e.preventDefault();
        $('.choice-payment-cod').html("<span class=\"text-success\">&#10004;Thanh toán khi nhận hàng!</span>");
    });
</script>