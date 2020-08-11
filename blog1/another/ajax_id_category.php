<?php
	include('./connect.php');
	$id = $_POST['id'];
	$query = "SELECT id FROM add_category WHERE id = $id";
	$execute = mysqli_query($connect, $query);
	$num = mysqli_num_rows($execute);
	if($num != 0)
	{
		echo 1;
	}
?>