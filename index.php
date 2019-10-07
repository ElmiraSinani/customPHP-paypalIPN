<?php

// Paypal IPN Tutorial
// http://jream.com

/**
How it works
1: A user buys something from your BUY button
2: The buyer button is configured with a URL for PayPal to go to when complate
3: The CALLBACK is on our site(This Page), It queries PayPal to see the result 
of the transaction just mode
4: if its good, we update some kind of record
*/

require 'Paypal_IPN.php';
$paypal = new Paypal_IPN('sandbox'); //live or sandbox

$paypal->run();
