<?php include_once (__DIR__.'/template/header.php'); ?>

    <div class="container">
        <!--        Cart Dropdown-->
        <div id="dropdownCart" class="cart dropdown text-right">
            <button class="btn btn-lg btn-outline-success btn-cart" type="button" id="dropdownCartBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i id="cartLogo" class="fa fa-shopping-cart"></i> (<?php
                $cart = new \Classes\Entity\Cart();
                echo $cart->getProductAmount();
                ?>) Cart
            </button>
            <ul id="dropdownCartMenu" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCart">
                <?php $cartProducts = $cart->getProducts();
                if (!empty($cartProducts)) {
                    foreach ($cartProducts as $cartProductId => $amount) {
                        $product = new \Classes\Entity\Product();
                        $product = $product->getProductById($cartProductId) ?>
                        <li>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="text-center cartItem">
                                        <i class="fa fa-2x <?php echo $product['img'] ?>"></i>
                                    </td>
                                    <td class="text-center cartItemName">
                                        <?php echo $product['name'] ?>
                                    </td>
                                    <td class="text-right cartItem">
                                        <input type="text" name="" value="<?php echo $amount ?>" size="1" class="form-control">
                                    </td>
                                    <td class="text-right cartItem">
                                        €<?php echo $product['price']*$amount; ?>
                                    </td>
                                    <td class="text-center cartItemBtns">
                                        <button type="button" title="refresh" class="btn btn-success btn-sm">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <button type="button" title="Delete" class="btn btn-danger btn-sm" onclick="$(this).cartProductRemove(<?php echo $product['id'] ?>)">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </li>
                    <?php } ?>

                    <li>
                        <div>
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td class="text-right">€<span id="totalPrice"><?php echo $cart->getTotalPrice() ?></span></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="text-right"><a href="clear.php"><strong><i class="fa fa-shopping-cart"></i> Clear</strong></a>&nbsp;&nbsp;&nbsp;<a href="#"><strong><i class="fa fa-share"></i> Order now</strong></a></p>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="text-center">Cart is empty</li>
                <?php } ?>
            </ul>
        </div>

        <div class="row text-center justify-content-center">

            <?php
            $products = new \Classes\Entity\Product();
            $products = $products->getAllProducts();
            foreach ($products as $product){
                ?>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="product border border-success rounded">
                        <div class="product-image">
                            <i class="fa fa-3x <?php echo $product['img']; ?>"></i>
                        </div>
                        <div>
                            <h6><?php echo $product['name'] ?></h6>
                            <p class="text-muted"><?php echo $product['description'] ?></p>
                        </div>
                        <div class="price">
                            <h5>€<?php echo $product['price'] ?></h5>
                        </div>
                        <div class="container-fluid border-top border-success">
                            <button class="btn btn-success btn-add-to-cart" data-product-id="<?php echo $product['id'] ?>"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

    <!-- Modal Added to cart -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<?php include_once (__DIR__.'/template/footer.php'); ?>