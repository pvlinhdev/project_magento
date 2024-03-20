require([
    'jquery',
    'Magento_Customer/js/customer-data'
], function ($, customerData) {
    'use strict';

    $(document).ready(function () {
        $('.cart.item').each(function () {
            var item = $(this);
            var qtyInput = item.find('.qty input');
            var incrementButton = item.find('.increase-qty');
            var decrementButton = item.find('.decrease-qty');

            incrementButton.click(function () {
                var currentQty = parseFloat(qtyInput.val());
                var newQty = currentQty + 1;
                qtyInput.val(newQty); // Update input value
                updateQty(item, newQty);
            });

            decrementButton.click(function () {
                var currentQty = parseFloat(qtyInput.val());
                if (currentQty > 1) {
                    var newQty = currentQty - 1;
                    qtyInput.val(newQty); // Update input value
                    updateQty(item, newQty);
                }
            });

            function updateQty(item, qty) {
                var itemId = item.find('[data-cart-item-id]').data('cart-item-id');
                var formData = {
                    'item_id': itemId,
                    'item_qty': qty
                };

                $.ajax({
                    url: '/checkout/cart/updateItemQty',
                    data: formData,
                    type: 'post',
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            // Reload cart data
                            var sections = ['cart'];
                            customerData.reload(sections, true);
                        } else {
                            console.error('Error updating quantity');
                        }
                    },
                    error: function () {
                        console.error('Error updating quantity');
                    }
                });
            }
        });
    });

    return function () {
        $(document).on('click', '.increase-qty, .decrease-qty', function () {
            updateCartPrice();
        });

        function updateCartPrice() {
            $.ajax({
                url: '/updatecart/cart/updatetotal', // Thay đổi đường dẫn này thành URL của controller của bạn
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    // Xử lý dữ liệu phản hồi và cập nhật giá giỏ hàng trên giao diện người dùng
                    if (response && response.total) {
                        $('.cart-subtotal').text(response.total);
                    }
                },
                error: function () {
                    console.error('Lỗi cập nhật tổng số giỏ hàng');
                }
            });
        }
    };
});