<?php 
	session_start();

	$id = strip_tags($_POST['id']);
	if(isset($_SESSION['product'][$id]))
		$count = $_SESSION['product'][$id] + 1;
	else
		$count = 1;

	$_SESSION['product'][$id] = $count;
?>