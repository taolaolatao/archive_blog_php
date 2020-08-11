<?php
	require('./connect.php');
	$username = $_POST['username'];
	$query_check_account = "SELECT * FROM sign_up WHERE username = '{$username}'";
	$execute_check_account = mysqli_query($connect, $query_check_account);
	$num = mysqli_num_rows($execute_check_account);
	if($num == 1)
	{
		echo 1;
	}
	else{
		echo 0;
	}
?>