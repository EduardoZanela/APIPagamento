<?php
	session_start();

	require_once('../vendor/autoload.php');

	use Omnipay\Omnipay;

	$gateway = Omnipay::create('PagSeguro');
	$gateway->setEmail("eduardogzanela@gmail.com");
	$gateway->setToken('2BBC1CB8B0944D7292870A82BD9E9BF7');
	$gateway->setSandbox(true); // right now i'm using testing environment

    $price = floatval ($_SESSION['price']);
    $_SESSION['valorComprado'] = $price;
    $_SESSION['pagamento'] = 'cartaoCreditoStripe';

	$transaction = $gateway->purchase(array(
		'amount' => $price,
		'name' => '123',
		'quantity' => 1,
		'description' => 'hello',
		'price' => 1,
		'currency' => 'BRL',
		'weight' => 10
	));

	try {
		$response = $transaction->send();
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage() . "\n";
		die($e->getMessage());
	}

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
