<?php

//Iniciamos a sessão
session_start();

//Incluimos a nossa classe
include_once('paypal.php');

//Se for utilizar o modo live, deixe a variavel $paypalmodo com o ponto(.) apenas
$paypalmodo = '.sandbox';
$moeda = 'USD';
$urlRetorno = 'http://localhost/APIPagamento/include/file.php';
$urlCancela = 'http://localhost/APIPagamento/include/file.php?api=failed';

//Parte que trata do SetExpressCheckout
if(isset($_POST) && !empty($_POST)){

    $itemNome = $_POST['itemNome'];
    $itemPreco = $_POST['itemPreco'];
    $itemQnt = $_POST['itemQnt'];
    $itemTotal = ($itemPreco*$itemQnt);

    $taxa = 1.50;

    $total = ($itemTotal + $taxa);

    $nvpData = '&METHOD=SetExpressCheckout'.
        '&RETURNURL='.urlencode($urlRetorno).
        '&CANCELURL='.urlencode($urlCancela).
        '&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode('Sale').
        '&L_PAYMENTREQUEST_0_NAME0='.urlencode($itemNome).

        '&L_PAYMENTREQUEST_0_AMT0='.urlencode($itemTotal).
        '&L_PAYMENTREQUEST_0_QTY0='.urlencode($itemQnt).

        '&NOSHIPPING=0'.

        '&PAYMENTREQUEST_0_ITEMAMT='.urlencode($itemTotal).
        '&PAYMENTREQUEST_0_TAXAMT='.urlencode($taxa).
        '&PAYMENTREQUEST_0_AMT='.urlencode($total).
        '&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($moeda).

        '&LOCALECODE=BR'.
        '&LOGOIMG='.'http://site.com/logo_a_utilizar_caso_tenha.jpg'.
        '&CARTBORDERCOLOR=45D765'.
        '&ALLOWNOTE=1';

//Definindo as as variaveis de SESSAO
    $_SESSION['itemNome'] = $itemNome;
    $_SESSION['itemPreco'] = $itemPreco;
    $_SESSION['itemQnt'] = $itemQnt;
    $_SESSION['itemTotal'] = $itemTotal;

    $_SESSION['taxa'] = $taxa;
    $_SESSION['total'] = $total;


//Instanciado a class paypal e chamando a função  de conexão api('SetExpressCheckout','paramentros_da_url') 
    $paypal = new paypal();
    $resposta = $paypal->api('SetExpressCheckout',$nvpData);

    if('SUCCESS' == strtoupper($resposta['ACK']) || 'SUCCESSWITHWARNING' == strtoupper($resposta['ACK'])){
        //Url de redirectionamento com os parâmetros inseridos
        $paypalUrl = 'https://www'.$paypalmodo.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$resposta["TOKEN"].'';
        header('Location:'.$paypalUrl);
    } else {
        echo '<div style="color:red"><b>Erro : </b>'.urldecode($resposta["L_LONGMESSAGE0"]).'</div>';
    }
    echo '<pre>';
    print_r($resposta);
    echo '</pre>';

}

//Parte que trata do DoExpressCheckout

if(isset($_GET['token']) && isset($_GET['PayerID'])){

    $token = $_GET['token'];
    $payer_id = $_GET['PayerID'];

    $itemNome = $_SESSION['itemNome'];
    $itemNum = $_SESSION['itemNum'];
    $itemQnt = $_SESSION['itemQnt'];
    $itemTotal = $_SESSION['itemTotal'];

    $taxa = $_SESSION['taxa'];
    $total = $_SESSION['total'];

    $nvpData = '&TOKEN='.urlencode($token).
        '&PAYERID='.urlencode($payer_id).
        '&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("Sale").

        '&L_PAYMENTREQUEST_0_NAME0='.urlencode($itemNome).
        '&L_PAYMENTREQUEST_0_AMT0='.urlencode($itemPreco).
        '&L_PAYMENTREQUEST_0_QTY0='.urlencode($itemQnt).

        '&PAYMENTREQUEST_0_ITEMAMT='.urlencode($itemTotal).
        '&PAYMENTREQUEST_0_TAXAMT='.urlencode($taxa).
        '&PAYMENTREQUEST_0_AMT='.urlencode($total).
        '&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($moeda);


//Instanciando a class paypal e chamando a função api('DoExpressCheckoutPayment','paramentros_da_url')         
    $paypal = new paypal();
    $resposta = $paypal->api('DoExpressCheckoutPayment',$nvpData);

    if('SUCCESS' == strtoupper($resposta['ACK']) || 'SUCCESSWITHWARNING' == strtoupper($resposta['ACK'])){

        echo "<h2 style='color:green;'>Concluído</h2>";
        echo "ID da sua compra: ".$resposta['PAYMENTINFO_0_TRANSACTIONID'];

        if('Completed' == $resposta['PAYMENTINFO_0_PAYMENTSTATUS']){
            session_destroy();
            echo '<div style="color:green">Pagamento completo! Obrigado pela compra.</div>';
        } else if('Peding' == $resposta['PAYMENTINFO_0_PAYMENTSTATUS']){
            echo '<div style="color:red">Transação completa, mas o pagamento precisa de ser aprovado manualmente na sua <a target="_new" href="http://www.paypal.com">Conta do PayPal</a></div>';
        }

        //Parte Responsavel por pegar os detalhes da transação
        //Esta parte só é exibida se a transação for efectuada com sucesso ou retornar Success
        $nvpData = '&TOKEN='.urlencode($token);
        $paypal = new paypal();
        $resposta = $paypal->api('GetExpressCheckoutDetails',$nvpData);

        if('SUCCESS' == strtoupper($resposta['ACK']) || 'SUCCESSWITHWARNING' == strtoupper($resposta['ACK'])){


            echo '<br /><b>Coisas para adicionar no banco de dados :</b><br /><pre>';

            echo '<pre>';
            print_r($resposta);
            echo '</pre>';
        } else  {
            echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($resposta["L_LONGMESSAGE0"]).'</div>';
            echo '<pre>';
            print_r(urldecode($resposta));
            echo '</pre>';


        }

    } else {
        //Esta parte é responsavel por verificar o erro caso a chamada api('DoExpressCheckoutPayment','paramentros') falhe.
        echo "Erro :".urldecode($resposta['L_LONGMESSAGE0']);
        echo "<pre>";
        foreach($resposta as $id=>$valor){
            echo "<div style='color:red; border:2px solid #ccc;'>[".$id."] => ".urldecode($valor)."<br/></div>";
        }
        echo "</pre>";
        die();
    }



}
?>