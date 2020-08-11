<?php
	require('./connect.php');
	$title = $_POST['title'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$content = $_POST['content'];


	$query_post_comment = "INSERT INTO comments(title, hoten, email, noi_dung, status) VALUES({$title}, '{$name}', '{$email}', '{$content}', 0)";
	$execute_post_comment = mysqli_query($connect, $query_post_comment) or die("Query: $query_post_comment <br />" . 'Error: ' . mysqli_error($connect));;
	if(mysqli_affected_rows($connect) == 1)
	{	
		echo 'Thành công';
	}
	else
	{
		echo 'Thất bại';
	}

?>