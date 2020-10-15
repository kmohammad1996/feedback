<?php
include ("functions/init.php");
if (logged_in()) {
    header("Location:/app");
}
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Sign up - Pro | Reply</title>
      <?php include 'includes/styles.php'; ?>
      <style>
      #card-element {
        margin-top: 20px;
        border: 1px solid rgba(0, 40, 100, 0.12);
        padding: 10px;
        border-radius: 3px;
      }
      </style>
   </head>
   <body>
      <div class="page">
         <div class="page-single">
            <div class="container">
               <div class="row">
                  <div class="col col-login mx-auto">
                     <div class="text-center mb-6">
                        <a class="header-brand" href="/">
                           <img src="<?php echo $url ?>/assets/images/transparent.svg" class="header-brand-img mr-2" alt="Reply Logo">
                           <h1 class="d-inline">Reply</h1>
                        </a>
                     </div>
                     <div class="card">
                        <div class="card-body p-6">
                           <div class="card-title text-center">Sign up for Reply Pro ($15/mo)</div>
                           <?php display_message(); ?>
                           <?php validate_user_registration(); ?>
                           <form method="post">
                              <div class="form-group">
                                 <label class="form-label">First Name</label>
                                 <input type="text" class="form-control" id="email" name="first_name" value="" placeholder="John" autofocus required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group">
                                 <label class="form-label">Last Name</label>
                                 <input type="text" class="form-control" id="email" name="last_name" value="" placeholder="Doe" autofocus required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group">
                                 <label class="form-label">Email Address</label>
                                 <input type="email" class="form-control" id="email" name="email" value="" placeholder="john.doe@gmail.com" autofocus required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group mb-6">
                                 <label class="form-label">
                                 Password
                                 </label>
                                 <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                 <div class="invalid-feedback"></div>
                                 <label style="margin-top: 20px;" class="form-label">
                                 Confirm Password
                                 </label>
                                 <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Your Password" required>
                                 <div class="invalid-feedback"></div>
                              </div>
                              <div class="form-group mb-6">
                                 <label style="margin-bottom: -10px; margin-top: -10px;" class="form-label">
                                 Payment Info
                                 </label>
                                 <div id="card-element">
                                 </div>
                              </div>
                              <input type="hidden" name="plan" value="pro">
                              <div class="form-footer">
                                 <a class="footerlink" href="/app/login">Already have an account?</a>
                                 <div class="footerspace">&nbsp;</div>
                                 <button type="submit" name="login-submit" id="login-btn" class="btn bg-camp btn-block p-2">Sign up</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="<?php echo $url ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/vendors/bootstrap.bundle.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/jscolor.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/clipboard.min.js"></script>
   <script src="<?php echo $url ?>/assets/js/dashboard.js"></script>
   <script src="https://js.stripe.com/v3/"></script>

<script>
var stripe = Stripe('');

var elements = stripe.elements();

var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

var card = elements.create('card', {style: style});

card.mount('#card-element');

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  form.submit();
}
</script>
</html>