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
                                <td class="text-center">
                                    <button type="button" title="refresh" class="btn btn-success btn-sm" onclick="$(this).cartProductQtyEdit()">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                    <button type="button" title="Delete" class="btn btn-danger btn-sm" onclick="$(this).cartProductRemove()">
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
                            <a href="clear.php"><strong><i class="fa fa-times"></i> Clear</strong></a>
                            <a href="#" style="margin-left: 1em;"><strong><i class="fa fa-share"></i> Order now</strong></a>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="text-center">Cart is empty</div>
                <?php } ?>
            </div>
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

<?php include_once (__DIR__.'/template/footer.php'); ?>