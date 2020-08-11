<?php
	require('./header.php');
	require('../another/connect.php');

?>

<div class="main">
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_user.php" style="color: #000"> Back </a>
	</div> <br />
	<?php
		if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
		{
			$id = $_GET['id'];
			$user_get = $_GET['user'];
			$query_list_user = "SELECT username, password, hoten, email, sdt, dia_chi, status FROM sign_up WHERE id = {$id}";
			$execute_list_user = mysqli_query($connect, $query_list_user);
			if(mysqli_num_rows($execute_list_user) == 1)
			{
				list($user, $pass, $name, $email, $phone, $address, $status) = mysqli_fetch_array($execute_list_user);
				$repass = $pass;
			}
			else{
				echo '<p class="alert alert-danger"> ID không tồn tại </p>';
				//header('location: http://localhost/blog/php/list_user.php');
			}
		}
		else{
			echo '<p class="alert alert-danger"> ID không tồn tại </p>';
		}


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
				if(!is_numeric($pass) && !is_numeric($repass))
				{
					$pass = $_POST['pass_old'];
					$repass = $_POST['repass_old'];
				}

				$query_check_user = "SELECT username FROM sign_up WHERE '{$user}' IN ( SELECT username FROM sign_up)";
				$execute_check_user = mysqli_query($connect, $query_check_user);
				$num = mysqli_num_rows($execute_check_user);

				if($num > 0)
				{
					$user = $_POST['user_old'];
				}	
				$pass_base64 = base64_encode($pass);
				$pass_sha1 = sha1($pass);

				$query_update_sign_in = "UPDATE sign_in SET tai_khoan = '{$user}', mat_khau = '{$pass_sha1}', status = {$status} WHERE tai_khoan = '{$user_get}'";
				$execute_update_sign_in = mysqli_query($connect, $query_update_sign_in) or die("Query: $query_update_sign_in <br />" . 'Error: ' . mysqli_error($connect));;

				$query_update_user = "UPDATE sign_up SET username = '{$user}', password = '{$pass_base64}', hoten = '{$name}', email = '{$email}', sdt = '{$phone}', dia_chi = '{$address}', status = $status WHERE id = {$id}";
				$execute_update_user = mysqli_query($connect, $query_update_user) or die("Query: $query_add_user <br />" . 'Error: ' . mysqli_error($connect));
				if(mysqli_affected_rows($connect) == 1)
				{
					header('location: http://localhost/blog/php/list_user.php');
				}
				else{
					echo '<p title="Thông báo" id="dialog-message" class="alert alert-warning"> Có lỗi khi cập nhật user! bạn có muốn tiếp tục? </p>';
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
					<legend> Sửa thông tin user:  <?php if(isset($user)) echo $user; ?> </legend>
			
					<div class="form-group">
						<label for=""> Tài khoản </label>
						<input type="text" name="username" class="form-control" id="user-add" placeholder="Username..." style="<?php if($_SESSION['username'] <> 'admin') echo 'cursor: not-allowed; user-select: none;'; ?>" required value="<?php if(isset($user)) echo $user; ?>" <?php if($_SESSION['username'] != 'admin') echo 'readonly'; ?>>
						<input type="hidden" name="user_old" value="<?php if(isset($user)) echo $user; ?>">
						<div class="alert alert-danger alert-dismissible fade in message" style="margin-top: 5px; display: none; transition: .3s ease;">
					    	<strong> Cánh báo! </strong> user đã tồn tại <a href="./list_user.php" class="alert-link">Xem danh sách user</a>.
					    	<a href="#" class="close" aria-label="close">&times;</a>
					  	</div>
					</div>
					<div class="form-group">
						<label for=""> Mật khẩu </label>
						<input type="password" name="password" class="form-control"placeholder="Passoword..." required value="<?php if(isset($pass)) echo $pass; ?>">
						<input type="hidden" name="pass_old" value="<?php if(isset($pass)) echo base64_decode($pass); ?>">
					</div>
					<div class="form-group">
						<label for=""> Xác nhận mật khẩu </label>
						<input type="password" name="repassword" class="form-control" placeholder="Enter password..." required value="<?php if(isset($repass)) echo $repass; ?>">
						<input type="hidden" name="repass_old" value="<?php if(isset($repass)) echo base64_decode($repass); ?>">
					</div>
					<div class="form-group">
						<label for=""> Họ tên </label>
						<input type="text" name="hoten" class="form-control" placeholder="Your name..." required value="<?php if(isset($name)) echo $name; ?>">
					</div>
					<div class="form-group">
						<label for=""> Email </label>
						<input type="email" name="email" class="form-control" placeholder="Your email..." required value="<?php if(isset($email)) echo $email; ?>">
					</div>
					<div class="form-group">
						<label for=""> Số điện thoại </label>
						<input type="number" name="sdt" class="form-control" placeholder="Phone number..." required value="<?php if(isset($phone)) echo $phone; ?>">
					</div>
					<div class="form-group">
						<label for=""> Địa chỉ </label>
						<input type="address" name="diachi" class="form-control" placeholder="Your address..." required value="<?php if(isset($address)) echo $address; ?>">
					</div>
					<div class="form-group">
						<label for=""> Trạng thái: </label> <br />
						<div class="radio">
							<label class="radio-inline" for="rd-status-user-enable">
								<input type="radio" name="status" id="rd-status-user-enable" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?>> Kích hoạt
							</label>
							<label class="radio-inline" for="rd-status-user-disable">
								<input type="radio" name="status" id="rd-status-user-disable" value="0" <?php if(isset($status) && $status == 0) echo 'checked' ?>> Vô hiệu hóa
							</label>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block"> Lưu thông tin user </button>
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

	$("#dialog-message").dialog({
      modal: true,
      buttons: {
        Yes: function() {
          $(this).dialog("close");
        },
        No: function() {
        	window.location.assign('http://localhost/blog/php/list_user.php');
        }
      }
    });

</script>