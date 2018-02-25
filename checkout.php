<?php include_once (__DIR__.'/template/header.php'); ?>

<div class="container">
    <?php include_once (__DIR__.'/template/cart.php'); ?>
    <form class="needs-validation col-xl-6 col-lg-6 col-md-9 col-sm-12 col-12 offset-sm-0 offset-0 offset-md-0 offset-lg-3 offset-xl-3" novalidate>
        <div class="form-group">
            <label for="checkoutInputEmail1">Email address</label>
            <input type="email" class="form-control" id="CheckoutInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
<!--            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            <div class="invalid-feedback">
                Please choose a email.
            </div>
        </div>
        <div class="form-group is-invalid">
            <label for="checkoutName">Name</label>
            <input type="text" class="form-control" id="checkoutInputName" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="checkoutSurname">Surname</label>
            <input type="text" class="form-control" id="checkoutInputSurname" placeholder="Surname" required>
        </div>
        <div class="form-group">
            <label for="checkoutTel">Telephone number</label>
            <input type="text" class="form-control" id="checkoutInputTel" placeholder="Telephone number">
        </div>
        <div class="text-right">
        <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>

    <form class="needs-validation" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mark" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustomUsername">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">City</label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom04">State</label>
                <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
                <div class="invalid-feedback">
                    Please provide a valid state.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom05">Zip</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
                <div class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                let forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                let validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</div>


<?php include_once (__DIR__.'/template/footer.php'); ?>
<script language="JavaScript" type="text/javascript" src="public/js/checkout.js"></script>