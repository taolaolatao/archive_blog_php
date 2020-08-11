<?php 
	session_start();
	$id = $_GET['id'];
	if($id == 0)
		unset($_SESSION['product']);
	else
		unset($_SESSION['product'][$id]);
	header('location:list_product.php');
	exit();
?>