$(document).ready(function () {

    //render select2
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $('.parallax100').parallax100();

    //view cart
    $(".wadtc img").click(function (e) {
        var cartcontent = $(".header-cart.header-dropdown"),
            ulcart = cartcontent.find('ul.header-cart-wrapitem'),
            total_cart = cartcontent.find('.header-cart-total'),
            btn_header = cartcontent.find('.header-cart-buttons');

        if (cartcontent.hasClass("show-header-dropdown")) { //not being opened
            $.ajax({
                url: my_ajax_object.ajax_url,
                type: 'GET',
                data: {
                    'action': 'get_cart'
                },
                dataType: 'json',
                success: function (data) {
                    ulcart.html('');
                    if (data.total_items > 0) {
                        $.each(data.items, function (k, p) {
                            ulcart.append(p.html)
                        });
                        total_cart.html("Total: " + data.total_price);
                        btn_header.html(data.cart_btn + data.checkout_btn);
                    } else {
                        ulcart.append(data.nf_wrap);
                        total_cart.html('Total: 0');
                        btn_header.html('');
                    }
                }
            });
        }
    });

    //delete individual item from cart
    $('body').on('click', '.dci', function (e) {
        e.preventDefault();
        console.log('Deleting...')
    });
});