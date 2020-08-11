<?php
	require('./header.php');
	require('../another/connect.php');

?>

<div class="main">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user = $_POST['username'];
			$pass = $_POST['password'];
			$repass = $_POST['repassword'];
			$name = $_POST['hoten'];
			$email = $_POST['email'];
			$phone = $_POST['sdt'];
			$address = $_POST['diachi'];
			$status = $_POST['status'];

			if(strcmp(trim($pass), trim($repass)) == 0)
			{
				
				$query_check_account = "SELECT * FROM sign_up WHERE username = '{$user}'";
				$execute_check_account = mysqli_query($connect, $query_check_account);
				$num = mysqli_num_rows($execute_check_account);

				if($num == 0)
				{
					$pass_base64 = base64_encode($pass);
					$pass_sha1 = sha1($pass);

					$query_add_sign_in = "INSERT INTO sign_in(tai_khoan, mat_khau, status) VALUES('{$user}', '{$pass_sha1}', $status)";
					$execute_add_sign_in = mysqli_query($connect, $query_add_sign_in) or die("Query: $query_add_sign_in <br />" . 'Error: ' . mysqli_error($connect));

					$query_add_user = "INSERT INTO sign_up(username, password, hoten, email, sdt, dia_chi, status) VALUES('{$user}', '{$pass_base64}', '{$name}', '{$email}', '{$phone}', '{$address}', $status)";
					$execute_add_user = mysqli_query($connect, $query_add_user) or die("Query: $query_add_user <br />" . 'Error: ' . mysqli_error($connect));
					if(mysqli_affected_rows($connect) == 1)
					{
						echo '<p class="alert alert-success"> Thêm user thành công </p>';
						$user = '';
						$pass = '';
						$repass = '';
						$name = '';
						$email = '';
						$phone = '';
						$address = '';
						$status = null;
					}
					else{
						echo '<p class="alert alert-danger"> Thêm user thất bại </p>';
					}
				}
				else
				{
					echo '<p class="alert alert-danger"> User đã tồn tại </p>';
				}
			}
			else
			{
				echo '<p class="alert alert-warning"> Mật khẩu không giống nhau </p>';
			}
		}
	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form action="" method="POST" role="form">
					<legend> <h2> Thêm User </h2> </legend>
			
					<div class="form-group">
						<label for=""> Tài khoản </label>
						<input type="text" name="username" class="form-control" id="user-add" placeholder="Username..." required value="<?php if(isset($user)) echo $user; ?>" maxLength="50">
						<div class="alert alert-danger alert-dismissible fade in message" style="margin-top: 5px; display: none; transition: .3s ease;">
					    	<strong> Cánh báo! </strong> user đã tồn tại <a href="./list_user.php" class="alert-link">Xem danh sách user</a>.
					    	<a href="#" class="close" aria-label="close">&times;</a>
					  	</div>
					</div>
					<div class="form-group">
						<label for=""> Mật khẩu </label>
						<input type="password" name="password" class="form-control" placeholder="Passoword..." required value="<?php if(isset($pass)) echo $pass; ?>" maxLength="50">
					</div>
					<div class="form-group">
						<label for=""> Xác nhận mật khẩu </label>
						<input type="password" name="repassword" class="form-control" placeholder="Enter password..." required value="<?php if(isset($repass)) echo $repass; ?>" maxLength="50">
					</div>
					<div class="form-group">
						<label for=""> Họ tên </label>
						<input type="text" name="hoten" class="form-control" placeholder="Your name..." required value="<?php if(isset($name)) echo $name; ?>" maxLength="100">
					</div>
					<div class="form-group">
						<label for=""> Email </label>
						<input type="email" name="email" class="form-control" placeholder="Your email..." required value="<?php if(isset($email)) echo $email; ?>" maxLength="50">
					</div>
					<div class="form-group">
						<label for=""> Số điện thoại </label>
						<input type="number" name="sdt" class="form-control" placeholder="Phone number..." required value="<?php if(isset($phone)) echo $phone; ?>" maxLength="12">
					</div>
					<div class="form-group">
						<label for=""> Địa chỉ </label>
						<input type="address" name="diachi" class="form-control" placeholder="Your address..." required value="<?php if(isset($address)) echo $address; ?>" maxLength="200">
					</div>
					<div class="form-group">
						<label> Trạng thái: </label> <br />
						<div class="radio">
							<label class="radio-inline" for="rd-status-user-enable">
								<input type="radio" name="status" id="rd-status-user-enable" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?>> Kích hoạt
							</label>
							<label class="radio-inline" for="rd-status-user-disable">
								<input type="radio" name="status" id="rd-status-user-disable" value="0" <?php if(isset($status) && $status == 0) echo 'checked' ?>> Vô hiệu hóa
							</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block"> Thêm user </button>
					<br /> <br />
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#user-add').blur(() => {
		var getUser = $('#user-add').val();
		$.post('../another/ajax_account.php', { username : getUser }, (data) => {
			if(data == 1)
			{
				$('.message').show();	
			}
			else
			{
				$('.message').hide(100);
			}
		});
	})
	$('.close').on('click', () => {
		$('.message').hide(100);
	});

</script>