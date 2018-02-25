$.getScript('public/js/Classes/Validator.js');


// Function reloads an element of the page
function refresh(element) {
    $(element).load(document.URL+' '+element+'>*');
    return true;
}


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
            url: getRoot()+'ajax/cart/addToCart.php',
            type: 'get',
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
            type: 'get',
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
        let quantity = $(this).closest('tr').find('.qty').val();


        if (!Validator.isInt(quantity)){
            $(this).closest('tr').find('.qty').addClass('text-danger');
            return;
        }

        $.ajax({
            url: getRoot()+'ajax/cart/productQtyEdit.php',
            type: 'get',
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