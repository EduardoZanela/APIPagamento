<?php

include '../DAO/ProductDAO.php';

session_start();

if(isset($_GET['productId'])){
    $array = array();
    $userDao = new ProductDAO();
    $array = $userDao->selectBuyProduct($_GET['productId']);

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


