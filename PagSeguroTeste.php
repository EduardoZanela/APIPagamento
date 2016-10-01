<?php
require_once 'PagSeguroLibrary/PagSeguroLibrary.php';

/** INICIO PROCESSO PAGSEGURO */
$paymentrequest = new PagSeguroPaymentRequest();

$data = Array(
    'id' => '01', // identificador
    'description' => 'Mouse', // descrição
    'quantity' => 1, // quantidade
    'amount' => 2.00, // valor unitário
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

$credentials = PagSeguroConfig::getAccountCredentials();//credenciais do vendedor

//$compra_id = App_Lib_Compras::insert($produto);
//$paymentrequest->setReference($compra_id);//Referencia;

$url = $paymentrequest->register($credentials);

header("Location: $url");
?>