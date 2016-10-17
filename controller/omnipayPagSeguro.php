<?php

require_once('/opt/lampp/htdocs/APIPagamento/vendor/autoload.php');

use Omnipay\Omnipay;

$gateway = Omnipay::create('PagSeguro');
$gateway->setEmail("eduardogzanela@gmail.com");
$gateway->setToken('2BBC1CB8B0944D7292870A82BD9E9BF7');
$gateway->setSandbox(true); // right now i'm using testing environment

$params = array(

    'price' => 2.00, // valor unitário

);
$response = $gateway->purchase($params)->send();

$paypalResponse = $response->getData();

var_dump( $paypalResponse );

if ($response->isSuccessful()) {
    // payment was successful: update database
    echo "OLA";
    // print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}
?>