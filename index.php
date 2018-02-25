<?php include_once (__DIR__.'/template/header.php'); ?>

    <div class="container">
        <?php include_once (__DIR__.'/template/cart.php'); ?>
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