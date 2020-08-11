<?php
	include('../another/connect.php');
	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min-range' => 1)))
	{
		$id = $_GET['id'];
		$query_del_category = "DELETE FROM add_category WHERE id = {$id}";
		$execute_del_category_query = mysqli_query($connect, $query_del_category) or die("Error: " . mysql_error($connect));;
		header('location: http://localhost/blog/php/list_category.php');
	}
	else{
		header('location: http://localhost/blog/php/list_category.php');
	}

	if(isset($_POST['bt_del_all_category']))
	{
		$query_del_all = 'DELETE FROM add_category';
		$execute_del_all = mysqli_query($connect, $query_del_all);
		header('location: http://localhost/blog/php/list_category.php');
	}
?>