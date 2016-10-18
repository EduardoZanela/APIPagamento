<?php

include '../DAO/ProductDAO.php';
include '../DAO/OrderDAO.php';

session_start();

if(isset($_GET['productId'])){
    $array = array();
    $userDao = new ProductDAO();
    $array = $userDao->selectBuyProduct($_GET['productId']);

    $order = new OrderDAO();
    $arrayOrder = $order->maxId();
    foreach ($arrayOrder as $b) {
        $_SESSION['maxid'] = $b['id'];
    }
    echo 'a';
    foreach ($array as $a) {
        echo "olas";
        echo $a['id'];
        $_SESSION['id'] = $a['id'];
        $_SESSION['name'] = $a['name'];
        $_SESSION['description'] = $a['description'];
        $_SESSION['price'] = $a['price'];
    }
    header("location:../view/pagamento.php");
}


