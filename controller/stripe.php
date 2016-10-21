<?php
    session_start();

    require_once('../vendor/autoload.php');

    use Omnipay\Omnipay;
    use Omnipay\Common\CreditCard;

	$gateway = Omnipay::create('Stripe');
    $gateway->setApiKey('sk_test_CHcjy1wiIiIJ8KJR7gHkVLOc');

    $price = floatval ($_SESSION['price']);
    $_SESSION['valorComprado'] = $price;
    $_SESSION['pagamento'] = 'cartaoCreditoStripe';

    $card = new CreditCard(array(
        'number'      => $_POST['cc_number'],
        'expiryMonth' => $_POST['cc_month'],
        'expiryYear'  => $_POST['cc_year'],
        'cvv'         => $_POST['cc_cvv']
    ));

    $transaction = $gateway->purchase(array(
        'amount'    => $price,
        'currency'  => 'BRL',
        'card'      => $card
    ));

    try {
        $response = $transaction->send();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        die($e->getMessage());
    }

    if ($response->isSuccessful()) {
        $_SESSION['id'] = $response->getTransactionReference();

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
