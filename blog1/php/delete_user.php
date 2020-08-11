<?php
	require_once('../another/connect.php');

	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
	{
		$id = $_GET['id'];
		$tai_khoan = $_GET['user'];
		$query_del_sign_in = "DELETE FROM sign_in WHERE tai_khoan = '{$tai_khoan}'";
		$execute_del_sign_in = mysqli_query($connect, $query_del_sign_in);

		$query_del_user = "DELETE FROM sign_up WHERE id = {$id}";
		$execute_del_user = mysqli_query($connect, $query_del_user);
		if(mysqli_affected_rows($connect) > 0)
		{
			header('location: http://localhost/blog/php/list_user.php');
		}
		else{
			header('location: http://localhost/blog/php/list_user.php');
		}
	}
	else{
		header('location: http://localhost/blog/php/list_user.php');
	}
?>