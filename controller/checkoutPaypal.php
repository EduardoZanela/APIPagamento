<?php

    session_start();

    require_once('C:\xampp\htdocs\APIPagamento\vendor\autoload.php');

    use Omnipay\Omnipay;

    $gateway = Omnipay::create('PayPal_Express');
    $gateway->setUsername("eduardogzanela_api1.gmail.com");
    $gateway->setPassword("LLYHX92UGA8C7A4X");
    $gateway->setSignature("AFeAQw6hVsiHbylx-T6lriIxBtbbAEze6E9jLxV3EAieywa.mDPwI4AQ");
    $gateway->setTestMode(true); // right now i'm using testing environment

    $price = floatval ($_SESSION['price']);

    echo $price;

    $params = array(
        'amount' => $price,
        'currency' => 'BRL',
        'returnUrl' => 'http://localhost/APIPagamento/controller/paypalCompletePurchase.php',
        'cancelUrl' => 'http://localhost/APIPagamento/view/index.php');

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