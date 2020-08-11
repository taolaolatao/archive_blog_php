<?php
	session_start();
	if(isset($_SESSION['uid']))
	{
		header('location: ./php/admin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Login </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
</head>
<body>
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(empty($_POST['username']) || empty($_POST['password']))
			{
				echo  '<p style="color: red; font-weight: bold; margin-left: 40px; margin-top: 10px; display: none;"> Bạn không được bỏ trống </p>';
			}
			else{
				$user = $_POST['username'];
				$pass = $_POST['password'];
				$_SESSION['user'] = $user;
				$_SESSION['pass'] = sha1($pass);
				header('Location: ./another/loading.php', true, 301);
			}
		}	
	?>
	<div class="background"> </div>
	<div class="container-login">
		<div class="img-sign-in">
			<img src="images/sign_up/117094_original_5760x3840.jpg" alt="image - sign in">
		</div>
		<div class="container-form">
			<form method="POST" action="" name="frm">
				<div class="front-sign-in">
					<h2> Login </h2>
					<label for="user">
						Tài khoản:
					</label>
					<input type="text" name="username" id="user" value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?>" required> <br />
					<label for="pass">
						Mật khẩu:
					</label>
					<input type="password" name="password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password']; ?>" id="pass" required>
					<?php 
						if(isset($_SESSION['wrong']))
						{
							echo '<p style="color: red; font-weight: bold; margin-left: 40px; margin-top: 10px;"> Sai username hoặc password </p>';
						} 		
					?>
					<input type="submit" name="bt-login" id="bt-login" value="Đăng nhập">
				</div>	
			</form>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(() => {
			'use stricts';
			$('#user').focus();
			$(document).keypress((e) => {
				if(e.keyCode == 13)
				{
					document.getElementById('bt-login').onclick();
				}
			})
		});
	</script>
</body>
</html>