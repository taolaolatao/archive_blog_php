<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Loading </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
</head>
<body>
	<div class="loading"> 
		<div class="container-loading">
			<div class="line">
				<div class="circle"> </div>
			</div>
			<div class="line">
				<div class="circle"> </div>
			</div>
			<div class="line">
				<div class="circle"> </div>
			</div>
			<div class="line">
				<div class="circle"> </div>
			</div>
			<div class="line">
				<div class="circle"> </div>
			</div>
			<div class="line">
				<div class="circle"> </div>
			</div>
		</div>
	</div>
	
	<?php
		session_start();
		require_once('../another/connect.php');
		$user =  $_SESSION['user'];
		$pass =  $_SESSION['pass']; 
		$sql_query = "SELECT * FROM sign_in WHERE tai_khoan = '{$user}' AND mat_khau = '{$pass}' AND status = 1";
		$query = mysqli_query($connect, $sql_query);
		$num = mysqli_num_rows($query);
		if($num == 0)
		{
			$_SESSION['wrong'] = 'issue';
			header('location: ../login.php', true, 301);	
		}
		else{
			session_unset('wrong');
			list($id, $username, $password, $status) = mysqli_fetch_array($query);
			$_SESSION['uid'] = $id;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
	?>
			<script type="text/javascript">
			 	setTimeout(() => {
			 		window.location="../php/admin.php";
				}, 3000);
			</script>
	<?php
		}
	?>

	
</body>
</html>