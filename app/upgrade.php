<?php
include ("functions/init.php");
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Upgrade to Pro | Reply</title>
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
                           <div class="card-title text-center">Upgrade to Pro ($15/mo)</div>
                           <form action="/app/upgradetopro.php" method="post">
                              <div class="form-group mb-6">
                                 <label style="margin-bottom: -10px; margin-top: 20px;" class="form-label">
                                 Payment Info
                                 </label>
                                 <div id="card-element">
                                 </div>
                                 <input type="hidden" name="userid" value="<?php echo $userid ?>">
                              </div>
                              <div class="form-footer">
                                 <a class="footerlink" href="/app/">Cancel</a>
                                 <div class="footerspace">&nbsp;</div>
                                 <button type="submit" name="login-submit" id="login-btn" class="btn bg-camp btn-block p-2">Upgrade</button>
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