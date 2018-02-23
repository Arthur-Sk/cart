function refresh(element) {
    $(element).load(document.URL+' '+element+'>*');
    return true;
}


$(document).ready(function () {

    // Adding product to cart
    var flag = false;
    $('.product').on('click', '.btn-add-to-cart', function () {

        // Anti-spam system
        if (flag){
            return
        }
        flag=true;

        var id = $(this).data('product-id');

        $.ajax({
            url: 'ajax/addToCart.php',
            type: 'get',
            data:'id='+id,
            success: function () {
                refresh('.container > #dropdownCart') },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

        // Shake animation
        setTimeout(function () {
            $('#cartLogo').addClass('shake');
            setTimeout (function(){
                $('.fa-shopping-cart').removeClass('shake');
                flag=false;
            },750)
        },250);
    });

    // Cart product removing
    $.fn.cartProductRemove = function (id) {
        $.ajax({
            url: 'ajax/deleteProduct.php',
            type: 'get',
            data: 'id='+id,
            success: function () {
                refresh('#dropdownCart');
            },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    };



});