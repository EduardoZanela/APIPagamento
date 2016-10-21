<?php
	session_start();

	header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

	require_once '../include/PagSeguroLibrary/PagSeguroLibrary.php';

	/** INICIO PROCESSO PAGSEGURO */
	$paymentrequest = new PagSeguroPaymentRequest();

	$price = floatval ($_SESSION['price']);

	$_SESSION['valorComprado'] = $price;
	$_SESSION['pagamento'] = 'pagSeguro';
	$_SESSION['id'] = $_SESSION['maxid'];

	include '../controller/orderRegister.php';

	$data = Array(
		'id' => '06', // identificador
		'description' => $_SESSION['name'], // descrição
		'quantity' => 1, // quantidade
		'amount' => $price, // valor unitário
		'weight' => 10 // peso em gramas
	);
	$item = new PagSeguroItem($data);
	/* $paymentRequest deve ser um objeto do tipo PagSeguroPaymentRequest */

	$paymentrequest->addItem($item);
	//Definindo moeda
	$paymentrequest->setCurrency('BRL');

	// 1- PAC(Encomenda Normal)
	// 2-SEDEX
	// 3-NOT_SPECIFIED(Não especificar tipo de frete)
	$paymentrequest->setShipping(3);
	//Url de redirecionamento
	//$paymentrequest->setRedirectURL($redirectURL);// Url de retorno
	$paymentrequest->setRedirectUrl("http://www.google.com.br");

	//$credentials = PagSeguroConfig::getAccountCredentials();//credenciais do vendedor

	//$compra_id = App_Lib_Compras::insert($produto);
	//$paymentrequest->setReference($compra_id);//Referencia;

	//$url = $paymentrequest->register($credentials);
	try {

		$credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
		$checkoutUrl = $paymentrequest->register($credentials);

	} catch (PagSeguroServiceException $e) {
		echo "Error: " . $e->getMessage() . "\n";
		die($e->getMessage());
	}

	header("Location: $checkoutUrl");
?>
