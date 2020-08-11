<?php
	include('../another/connect.php');
	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
	{
		$id = $_GET['id'];
		$query_del_img = "SELECT anh FROM image_post WHERE id = {$id}";
		$execute_del_img = mysqli_query($connect, $query_del_img);
		$result = mysqli_fetch_assoc($execute_del_img);
		unlink($result['anh']);
		$query_del_img_db = "DELETE FROM image_post WHERE id = {$id}";
		$execute_del_img_db = mysqli_query($connect, $query_del_img_db);
		header('location: http://localhost/blog/php/list_image.php');
	}
	else{
		header('location: http://localhost/blog/php/list_image.php');
	}
?>