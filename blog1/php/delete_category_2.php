<?php
	require('../another/connect.php');

	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min-range' => 1)))
	{
		$id = $_GET['id'];
		$query_dele_cate = "DELETE FROM menu WHERE ID = {$id}";
		$execute_dele_cate = mysqli_query($connect, $query_dele_cate);
		if(mysqli_affected_rows($connect) == 1)
		{
			header("location: ./list_category_2.php");
		}
		else
		{
			header("location: ./list_category_2.php");
		}
	}
	else
	{
		header("location: ./list_category_2.php");
	}
?>