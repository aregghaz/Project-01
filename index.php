<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
    <title>Title</title>
</head>
<body>
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="js.mini.js"></script>
<form action="payment.php" method="post" class="ui form" id="payment_form">
    <div class="field">
        <input type="text" name="name" required placeholder="your name" value="Michael Harris">
    </div>
    <div class="field">
        <input type="email" name="email" required placeholder="email@xxxx.xxx" value="michael.harris.68@example.com">
    </div>
    <div class="field">
        <input type="text" placeholder="card number" data-stripe="number" value="4242 4242 4242 4242">
    </div>
    <div class="field">
        <input type="text" placeholder="MM" data-stripe="exp_month" value="12">
    </div>
    <div class="field">
        <input type="text" placeholder="YY" data-stripe="exp_year" value="18">
    </div>
    <div class="field">
        <input type="text" placeholder="cvc" data-stripe="cvc" value="123">
    </div>
    <button class="ui button" type="submit">Biling</button>
</form>

<script>

    Stripe.setPublishableKey('pk_test_LKR052RDgmb8Nj20Zk1ULfnl');

     var $form =$('#payment_form');
    $form.submit(function (e) {
        e.preventDefault()
        $form.find('.button').attr('disabled', true);
        Stripe.card.createToken($form, function(status, response) {

            if (response.error) {
               $form.find('.message').remove()
               $form.prepend('/<div class="ui negative message"><p>/' + response.error.message + '/</p></div>/')

           } else {

               var token = response.id
               $form.append('<input type="hidden"  name="stripeToken" >').val(token);
               $form.get(0).submit()

           }
        })

    });
</script>
</body>
</html>