<?php
	require('../another/connect.php');
	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
	{
		$id = $_GET['id'];
		$query_select = "SELECT anh FROM category_post WHERE id = {$id}";
		$execute_select = mysqli_query($connect, $query_select);
		$result_del = mysqli_fetch_assoc($execute_select);
		unlink($result_del['anh']);

		$query_del = "DELETE FROM category_post WHERE id = {$id}";
		$execute_del = mysqli_query($connect, $query_del);

		if(mysqli_affected_rows($connect) == 1)
		{
			header('location: ./list_post.php');
		}
		else{
			header('location: ./list_post.php');
		}
	}
	else{
		header('location: ./list_post.php');
	}
?>