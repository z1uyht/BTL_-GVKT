<footer class="main">

    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="index.php"><img src="./public/assets/imgs/logo/logoshop2023.png" alt="logo"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Liên hệ</h5>
                        <p class="wow fadeIn animated">
                            <strong>Địa chỉ: </strong>Mai Dịch, Hà Nội
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Số điện thoại: </strong>+84 999 999 999
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Email: </strong>team@gmail.com
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Shop nhé❤️</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="public/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                            <a href="#"><img src="public/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                            <a href="#"><img src="public/assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Team19</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Thông tin giao hàng</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều kiện</a></li>
                        <li><a href="#">Liên hệ chúng tôi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Tài khoản của tôi</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="my-account.html">Thông tin</a></li>
                        <li><a href="#">Giỏ hàng</a></li>

                        <li><a href="#">Đơn hàng</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated mob-center">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">
                    <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
                </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    &copy; <strong class="text-brand"></strong> All rights reserved
                </p>
            </div>
        </div>
    </div>

    <div class="toastr_notification">
    </div>
</footer>
<!-- Vendor JS-->
<script src="public/assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="public/assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="public/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="public/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="public/assets/js/plugins/slick.js"></script>
<!-- <script src="public/assets/js/plugins/jquery.syotimer.min.js"></script> -->
<script src="public/assets/js/plugins/wow.js"></script>
<script src="public/assets/js/plugins/jquery-ui.js"></script>
<script src="public/assets/js/plugins/perfect-scrollbar.js"></script>
<script src="public/assets/js/plugins/magnific-popup.js"></script>
<script src="public/assets/js/plugins/select2.min.js"></script>
<script src="public/assets/js/plugins/waypoints.js"></script>
<script src="public/assets/js/plugins/counterup.js"></script>
<script src="public/assets/js/plugins/jquery.countdown.min.js"></script>
<script src="public/assets/js/plugins/images-loaded.js"></script>
<script src="public/assets/js/plugins/isotope.js"></script>
<script src="public/assets/js/plugins/scrollup.js"></script>
<script src="public/assets/js/plugins/jquery.vticker-min.js"></script>
<script src="public/assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="public/assets/js/plugins/jquery.elevatezoom.js"></script>
<!-- Template  JS -->
<script src="public/assets/js/main.js?v=3.3"></script>
<script src="public/assets/js/shop.js?v=3.3"></script>
<script src="public/assets/js/toastr.min.js"></script>


<!--# ADD TO CART MESSAGE #-->
<script type="text/javascript">
function success_toast(details, title) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    //toastr["success"]("Your product is added to cart successfully!", "Congratulation")
    toastr["success"](details, title)
}

function warning_toast(details, title) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr["warning"](details, title)
}
</script>

<script>
$(window).on('load', function() {
    $('body').removeClass('preloading');
    $('.load-customer').delay(1).fadeOut('fast');
});
$(document).ready(function() {
    $('.cart_product').load("app/Handle/loadCart.php");
    $('.add_to_cart').click(function(e) {
        e.preventDefault();
        let product_sc_id = $('#idProductsSC').val();
        let product_name = $('.title-detail').text();
        let product_qty = $('.qty-val').text();
        console.log(product_sc_id);
        console.log(product_name);
        console.log(product_qty);
        $.ajax({
            url: 'app/Handle/addToCart.php',
            type: 'POST',
            data: {
                product_sc_id: $('#idProductsSC').val(),
                product_name: $('.title-detail').text(),
                product_qty: $('.qty-val').text(),
            },
            success: function(data) {
                $('.cart_product').load("app/Handle/loadCart.php");
                $('.toastr_notification').html(data);
            }
        });
    });
});
</script>
</body>

</html>