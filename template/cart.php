<div id="dropdownCart" class="cart dropdown text-right">
    <button class="btn btn-lg btn-outline-success btn-cart" type="button" id="dropdownCartBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i id="cartLogo" class="fa fa-shopping-cart"></i> (<?php
        $cart = new \Classes\Entity\Cart();
        echo $cart->getProductAmount();
        ?>) Cart
    </button>
    <div id="dropdownCartMenu" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCart">
        <?php $cartProducts = $cart->getProducts();
        if (!empty($cartProducts)) { ?>
            <table class="table table-hover">
                <?php foreach ($cartProducts as $cartProductId => $amount) {
                    $product = new \Classes\Entity\Product();
                    $product = $product->getProductById($cartProductId) ?>

                    <tr data-product-id="<?php echo $product['id'] ?>">
                        <td class="text-center">
                            <i class="fa fa-2x <?php echo $product['img'] ?>"></i>
                        </td>
                        <td class="text-center">
                            <?php echo $product['name'] ?>
                        </td>
                        <td class="text-right">
                            <input type="text" value="<?php echo $amount ?>" class="form-control text-center qty">
                        </td>
                        <td class="text-right">
                            €<?php echo $product['price']*$amount; ?>
                        </td>
                        <td class="text-center row">
                            <button type="button" title="refresh" class="btn btn-success btn-sm" style="margin: 0.1em" onclick="$(this).cartProductQtyEdit()">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" title="Delete" class="btn btn-danger btn-sm" style="margin: 0.1em" onclick="$(this).cartProductRemove()">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <div>
                <table class="table table-bordered">
                    <tr>
                        <td class="text-right"><strong>Total</strong></td>
                        <td class="text-right">€<span id="totalPrice"><?php echo $cart->getTotalPrice() ?></span></td>
                    </tr>
                </table>
                <p class="text-right">
                    <a href="" id="btn-cart-clear"><strong><i class="fa fa-times"></i> Clear</strong></a>
                    <a href="checkout.php" style="margin-left: 1em;"><strong><i class="fa fa-share"></i> Order now</strong></a>
                </p>
            </div>
        <?php } else { ?>
            <div class="text-center">Cart is empty</div>
        <?php } ?>
    </div>
</div>