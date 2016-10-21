<?php

session_start();

require_once('../include/functions.php');
require_once('../vendor/autoload.php');

use Omnipay\Omnipay;

$gateway = Omnipay::create('PayPal_Express');
$gateway->setUsername("eduardogzanela_api1.gmail.com");
$gateway->setPassword("LLYHX92UGA8C7A4X");
$gateway->setSignature("AFeAQw6hVsiHbylx-T6lriIxBtbbAEze6E9jLxV3EAieywa.mDPwI4AQ");
$gateway->setTestMode(true); // right now i'm using testing environment

$token = $_GET['token'];
$payer = $_GET['PayerID'];

$price = floatval ($_SESSION['price']);

$_SESSION['valorComprado'] = $price;
$_SESSION['pagamento'] = 'paypal';
$_SESSION['id'] = $token;
include '../controller/orderRegister.php';

$params = array(
    'amount' => $price,
    'currency' => 'BRL',
    'token' => "$token",
    'PayerID'=>"$payer",
    'returnUrl' => 'http:' . get_dir() . 'paypalCompletePurchase.php',
    'cancelUrl' => 'http:' . ROOT . 'view/index.php');

try {
	$response = $gateway->completePurchase($params)->send();
} catch (Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
    die($e->getMessage());
}

$paypalResponse = $response->getData();

if ($response->isSuccessful()) {
    // payment was successful: update database
    header("location:../view/complete.php");
    // print_r($response);
} elseif ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}
?>
