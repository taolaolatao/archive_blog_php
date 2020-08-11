<?php
	$connect = mysqli_connect('localhost', 'root', 'admin123', 'blog_basic') or die('Error: ' . mysql_errno($connect));
	if(!$connect)
	{
		echo 'Kết nối thất bại!';
	}
	else{ mysqli_set_charset($connect, 'utf8'); }
?>