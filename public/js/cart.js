$.getScript(getRoot()+'public/js/Classes/Validator.js');
$.getScript(getRoot()+'public/js/functions.js');


$(document).ready(function () {

    // Adding product to cart
    let flag = false;
    $('.product').on('click', '.btn-add-to-cart', function () {

        // Anti-spam system
        if (flag){
            return;
        }
        flag=true;

        let id = $(this).data('product-id');

        $.ajax({
            url: getRoot()+'ajax/cart/saveCart.php',
            type: 'post',
            data:'id='+id,
            success: function () {
                refresh('#dropdownCart') },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

        // Shake animation
        setTimeout(function () {
            $('#cartLogo').addClass('shake');
            setTimeout (function(){
                $('#cartLogo').removeClass('shake');
                flag=false;
            },750);
        },250);
    });

    // Cart clear button
    $('#dropdownCart').on('click', '#btn-cart-clear', function (e) {

        e.preventDefault();
        $.ajax({
            url: getRoot()+'ajax/cart/clear.php',
            success: function () {
                refresh('#dropdownCart') },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    // Cart each product stack deletion
    $.fn.cartProductRemove = function () {
        event.stopPropagation();
        let id = $(this).closest('tr').data('product-id');

        $.ajax({
            url: getRoot()+'ajax/cart/deleteProduct.php',
            type: 'post',
            data: {'id':id},
            success: function () {
                refresh('#dropdownCart');
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    };

    // Cart product quantity edition
    $.fn.cartProductQtyEdit = function () {
        event.stopPropagation();
        let id = $(this).closest('tr').data('product-id');
        let input = $(this).closest('tr').find('.qty');
        let quantity = input.val();


        // Validate, if product quantity is integer and not more that provided number
        if (!Validator.isInt(quantity) || !Validator.maxNum(quantity,99)){
            input.addClass('is-invalid');
            return;
        }

        $.ajax({
            url: getRoot()+'ajax/cart/saveCart.php',
            type: 'post',
            data: {'id': id, 'quantity': quantity},
            success: function () {
                refresh('#dropdownCart');
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    };



});