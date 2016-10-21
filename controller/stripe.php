<?php
    use Omnipay\Omnipay;

    $gateway = Omnipay::create('Stripe');
    $gateway->setApiKey('abc123');

    $price = floatval ($_SESSION['price']);
    $_SESSION['valorComprado'] = $price;
    $_SESSION['pagamento'] = 'cartaoCreditoStripe';


    $formData = array(
        'number' => '4242424242424242',
        'expiryMonth' => '6',
        'expiryYear' => '2016',
        'cvv' => '123'
    );

    $response = $gateway->purchase(array(
        'amount' => $price,
        'currency' => 'BRL',
        'card' => $formData
    ))->send();

    if ($response->isSuccessful()) {
        // payment was successful: update database
        //print_r($response);
        $_SESSION['id'] = $response->id;
        include '../controller/orderRegister.php';
        header("location:../view/complete.php");
    } elseif ($response->isRedirect()) {
        // redirect to offsite payment gateway
        $response->redirect();
    } else {
        // payment failed: display message to customer
        echo $response->getMessage();
    }
?>
