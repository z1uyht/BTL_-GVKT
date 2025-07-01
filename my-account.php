<?php
include('app/Controllers/View.php');
$view = new View();
$view->loadContent("include", "session");
$view->loadContent('include', 'top');
$view->loadContent('content', 'my-account');
$view->loadContent('include', 'tail');
?>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var div_id = $(input).attr('set-to');
        reader.onload = function(e) {
            $('#' + div_id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(".default").change(function() {
    readURL(this);
});

var order_id = 0;
$('.view-detail').click(function(e) {
    e.preventDefault();
    order_id = $(this).data('itemid');
    console.log(order_id);
    $.ajax({
        url: 'app/Handle/loadOrderItems.php',
        type: 'POST',
        data: {
            order_id: order_id,
        },
        success: function(data) {
            $('#load-order-items').html(data);
        }
    });
});

var starValue = 0;
const stars = document.querySelectorAll('.stars-rating');
stars.forEach(star => {
    star.addEventListener('click', function() {
        starValue = star.value;
        console.log("Rating: " + starValue);
    });
});

$('#close-popup').click(function(e) {
    e.preventDefault();
    console.log("click close");
    $('#popup-main').removeClass('popup-main');
    $('#popup').removeClass('open-popup');
    $('#backdrop').removeClass('backdrop');
});

$(".customer_image").change(function(e) {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
        warning_toast("Vui lòng chọn file với định dạng JPEG/JPG/PNG", "LỖI");
        $(".customer_image").val('');
        return false;
    } else if (file.size > 2000000) {
        warning_toast("Ảnh quá lớn. Vui lòng chọn ảnh khác", "LỖI");
        $(".customer_image").val('');
        return false;
    }
});
$(document).ready(function(e) {
    $('#fupForm').on('submit', function(e) {
        e.preventDefault();
        console.log("click submit info customer");
        $.ajax({
            type: 'POST',
            url: 'app/Handle/updateInfoCustomer.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.type == "error") {
                    warning_toast(data.message, data.title);
                } else {
                    success_toast(data.message, data.title);
                    $('#customer_name_status').html(data.name);
                    $('.customer_name_top').html(data.name);
                }
            }
        })
    });
});

//change password
$('#submit-change-password').click(function(e) {
    e.preventDefault();
    console.log("click submit change password");
    $.ajax({
        type: 'POST',
        url: 'app/Handle/changePassword.php',
        data: {
            old_password: $('.customer_pass_current').val(),
            new_password: $('.customer_npass').val(),
            confirm_password: $('.customer_cpass').val(),
        },
        dataType: 'json',
        success: function(data) {
            if (data.type == "error") {
                warning_toast(data.message, data.title);
            } else {
                success_toast(data.message, data.title);
                $('.customer_pass_current').val(data.password);
                $('.customer_npass').val('');
                $('.customer_cpass').val('');
            }
        }
    })
});
</script>