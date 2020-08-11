<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Test Send Mail </title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">

	<!-- jQuery first, then Popper.js and Bootstrap JS. -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
		include('inc/config.php');
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$subject = $_POST['subject'];
			$content = "
				<p>Name: 	${name}</p>
				<p>Address: ${address}</p>
				<p>Phone:  	${phone}</p>
				<p>Email: 	${email}</p>
			";

			send_mail('minhhuynhvu9221@gmail.com', GUSER, 'Send Mail', 'Thông tin liên hệ', $content);
		}

	?>
	<div class="container">
		<div class="row">
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form name="frm" method="post" action="">
					<table class="table table-responsive table-hover table-danger table-inverse">
						<thead>
							<tr>
								<td colspan="2" align="center">
									<h1>Test Send Mail</h1>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><h2> Họ tên:</h2></td>
								<td>
									<input class="form-control" type="text" name="name" autocomplete="off">
								</td>
							</tr>
							<tr>
								<td><h2> Địa chỉ:</h2></td>
								<td>
									<input class="form-control" type="text" name="address" autocomplete="off">
								</td>
							</tr><tr>
								<td><h2> Phone:</h2></td>
								<td>
									<input class="form-control" type="number" name="phone" autocomplete="off">
								</td>
							</tr>
							<tr>
								<td><h2> Email:</h2></td>
								<td>
									<input class="form-control" type="email" name="email" autocomplete="off">
								</td>
							</tr>
							<tr>
								<td><h2> Họ tên:</h2></td>
								<td>
									<textarea class="form-control" name="subject" rows="5"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<button type="submit" class="btn btn-outline-danger btn-lg btn-block">Gửi Mail</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>


</body>
</html>