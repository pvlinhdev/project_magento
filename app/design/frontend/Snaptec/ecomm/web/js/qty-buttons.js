// require(['jquery'], function ($) {
//     $(document).ready(function () {
//         $('.qty').each(function () {
//             var $qty = $(this);
//             var $input = $qty.find('input');
//             var $buttonMinus = $('<button type="button" class="quantity-button quantity-down">-</button>');
//             var $buttonPlus = $('<button type="button" class="quantity-button quantity-up">+</button>');

//             $input.after($buttonMinus);
//             $input.after($buttonPlus);

//             $buttonMinus.on('click', function () {
//                 var value = parseInt($input.val(), 10);
//                 value = isNaN(value) ? 0 : value;
//                 value = value <= 1 ? 1 : value - 1;
//                 $input.val(value);
//             });

//             $buttonPlus.on('click', function () {
//                 var value = parseInt($input.val(), 10);
//                 value = isNaN(value) ? 1 : value + 1;
//                 $input.val(value);
//             });
//         });
//     });
// });