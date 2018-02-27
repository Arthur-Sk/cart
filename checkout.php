<?php include_once (__DIR__.'/template/header.php'); ?>

<div class="container">
    <?php include_once (__DIR__.'/template/cart.php'); ?>

    <div class="col-xl-6 col-lg-6 col-md-9 col-sm-12 col-12 offset-sm-0 offset-0 offset-md-0 offset-lg-3 offset-xl-3">

        <div class="text-center">
            <div class="custom-control custom-radio custom-control-inline col-4">
                <input type="radio" id="cardRadio" name="checkoutRadio" class="custom-control-input" checked="checked" onclick="$('#bankForm').hide(); $('#cardForm').show();">
                <label class="custom-control-label" for="cardRadio"><img class="img-checkout" src="public/images/credit-card-icons.png"></label>
            </div>
            <div class="custom-control custom-radio custom-control-inline col-4">
                <input type="radio" id="bankRadio" name="checkoutRadio" class="custom-control-input" onclick="$('#cardForm').hide(); $('#bankForm').show();">
                <label class="custom-control-label" for="bankRadio"><img class="img-checkout" src="public/images/Bank-Icon-2.png"></label>
            </div>
        </div>

        <!-- Checkout card form-->
        <form action="paid.php" method="post" id="cardForm" class="needs-validation" novalidate>
            <div class="form-group">
                <label class="required control-label" for="checkoutName">Name on card</label>
                <input name="nameOnCard" type="text" class="form-control" id="checkoutName" placeholder="Name" minlength="3" maxlength="50" required>
                <div class="invalid-feedback">
                    Minimum length is 3 symbols
                </div>
            </div>
            <div class="form-group">
                <label class="required control-label" for="checkoutCardNum">Card number</label>
                <input name="cardNumber" type="text" pattern="\d*" class="form-control" id="checkoutCardNum" placeholder="Card number" minlength="16" maxlength="16" required>
                <div class="invalid-feedback">
                    Card number must contain 16 numbers
                </div>
            </div>
            <div class="form-group">
                <label class="required control-label" for="checkoutCVV">CVV</label>
                <input name="CVV" type="text" pattern="\d*" class="form-control" id="checkoutCVV" placeholder="CVV" minlength="3" maxlength="3" required>
                <div class="invalid-feedback">
                    CVV must contain 3 numbers
                </div>
            </div>
            <div class="form-group">
                <label class="required control-label" for="checkoutEmail">Email address</label>
                <input name="email" type="email" class="form-control" id="CheckoutEmail" aria-describedby="emailHelp" placeholder="Enter email" minlength="3" maxlength="32" required>
                <div class="invalid-feedback">
                    Please choose correct email
                </div>
            </div>
            <div class="form-group">
                <label for="checkoutTel">Telephone number</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">+</div>
                    </div>
                    <input name="telNumber" type="text" pattern="\d*" class="form-control" id="checkoutTel" placeholder="Telephone number" maxlength="32">
                    <div class="invalid-feedback">
                        Incorrect telephone number
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkoutCheck" required>
                        <label class="form-check-label control-label required" for="checkoutCheck">Agree to terms and conditions</label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="event.preventDefault(); window.location.replace(getRoot())">Back</button>
                <button class="btn btn-success" type="submit">Continue</button>
            </div>
            <div hidden>
                <input name="paymentType" value="Card">
            </div>
        </form>

        <!-- Checkout bank form-->
        <form id="bankForm" action="paid.php" method="post" style="display: none" novalidate>
            <p>iBank</p>
            <div hidden>
                <input name="paymentType" value="iBank">
            </div>
            <button class="btn btn-secondary" onclick="event.preventDefault(); window.location.replace(getRoot())">Back</button>
            <button class="btn btn-success" type="submit">Continue</button>
        </form>
    </div>
</div>




<?php include_once (__DIR__.'/template/footer.php'); ?>
<script language="JavaScript" type="text/javascript" src="public/js/checkout.js"></script>