<?php
	include '../model/order.php';
	include '../DAO/OrderDAO.php';

	echo 'ola';

	$order = new OrderModel();

	$order->comprador = 'Comprador fixo';
	$order->valorComprado = $_SESSION['valorComprado'];
	$order->paymentMethod = $_SESSION['pagamento'];
	$order->idmetodo = $_SESSION['id'];

	$orderDAO = new orderDAO();
	$orderDAO->insertOrder($order);
?>
