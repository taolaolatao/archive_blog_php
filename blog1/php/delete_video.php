<?php
	include('../another/connect.php');
	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min-range' => 1)))
	{
		$id = $_GET['id'];
		$query_del_video = "DELETE FROM video WHERE id = {$id}";
		$execute_del_video_query = mysqli_query($connect, $query_del_video) or die("Error: " . mysql_error($connect));;
		header('location: http://localhost/blog/php/list_video.php');
	}
	else{
		header('location: http://localhost/blog/php/list_video.php');
	}

	if(isset($_POST['bt_del_all_video']))
	{
		$query_del_all_video = "DELETE FROM video";
		$execute_del_video_query = mysqli_query($connect, $query_del_all_video);
		header('location: http://localhost/blog/php/list_video.php');
	}
?>