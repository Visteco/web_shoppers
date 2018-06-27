<?php
require_once(public_path('braintreeConfig.php'));
//echo $paymentAmount."*****".$expiryDate."*****".$cardCvv."*****".$cardNumber."*****".$currencyCodeType."*****".$payment_method_nonce;
//die;
$result = Braintree_Transaction::sale(array(
    'amount' => $paymentAmount,
    'channel'=> 'PP-DemoPortal-BT-HF_PP-php',
    'paymentMethodNonce' => $payment_method_nonce,
    'customer' => array(
        'firstName' => 'abc',
        'lastName' => 'abc',
    ),
    'shipping' => array(
        'firstName' => 'abc',
        'lastName' => 'abc',
        'streetAddress' => 'abc',
        'extendedAddress' => 'abcc',
        'locality' => 'c',
        'region' => 's',
        'postalCode' => '211212',
        'countryCodeAlpha2' => 's'
    )
));
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h4>
            <?php echo('Thank you for your Payment!');?><br/><br/>
            <br/>
<h4>Transaction ID : <?php echo($result->transaction->id);?> <br/>
            State : Approved  <br/>
            Total Amount: <?php echo($paymentAmount);?> &nbsp;<?php echo($currencyCodeType); ?> <br/>
        </h4>
        <br/>
        Return to <a href="">home page</a>.
    </div>
    <div class="col-md-4"></div>
</div>
