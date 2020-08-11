<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Insert</title>
	
	<?php include('../inc/connect.php'); include('../inc/fw.php'); ?>
</head>
<body>
	<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
		<div class="container">
	  <a class="navbar-brand" href="../index.php">Admin</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-item nav-link active" href="./insert.php">Insert Data<span class="sr-only">(current)</span></a>
	      <a class="nav-item nav-link" href="#">List Data</a>
	    </div>
	  </div>
	  </div>
	</nav>



	<div class="container">
		<div class="row mb-4">
			<div class="col-12 col-xs-12 col-sm-8 col-md-8 col-lg-8 m-auto">
	<?php 
		$connect = new Connection();
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$name = addslashes(strip_tags($_POST['name']));
			$image = addslashes(strip_tags($_POST['image']));
			$price = addslashes(strip_tags($_POST['price']));
			$unit = addslashes(strip_tags($_POST['unit']));

			$data = array($name,$image,$price,$unit);
			$result = $connect->insert('product', $data);
			if($result)
				$mess_done = '';
			else
				$mess_false = '';
		}

	?>
				<form method="post" action="" name="frm">
					<div class="form-group">
					  <label class="col-form-label col-form-label-lg" for="inputLarge">Name Product</label>
					  <input class="form-control form-control-lg" type="text" placeholder="Tên..." id="name" name="name" autocomplete="off" required>
					</div>
					<div class="form-group">
					  <label class="col-form-label col-form-label-lg" for="inputLarge">Image Product</label>
					  <input class="form-control form-control-lg" type="text" placeholder="Ảnh..." id="image" name="image" autocomplete="off" required>
					</div>
					<div class="form-group">
					  <label class="col-form-label col-form-label-lg" for="inputLarge">Price</label>
					  <input class="form-control form-control-lg" type="number" placeholder="Giá..." id="price" name="price" autocomplete="off" required>
					</div>
					<div class="form-group">
					  <label class="col-form-label col-form-label-lg" for="inputLarge">Unit</label>
					  <input class="form-control form-control-lg" type="text" placeholder="Đơn vị..." id="unit" name="unit" autocomplete="off" required>
					</div>
					<button type="submit" class="btn btn-outline-primary btn-lg btn-block">Insert Data</button>
					<button type="reset" class="btn btn-danger btn-lg btn-block">Reset</button>
				</form>
				<div style="position: fixed; right: 0; bottom:0; opacity: 0; transition: .3s; z-index: 10000" class="alert alert-dismissible alert-success" id="alert-done">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
				</div>
		<script type="text/javascript">
			<?php if(isset($mess_done)){ ?>
					var mess_done = document.getElementById('alert-done');
					mess_done.style.opacity = '1';
					setTimeout(()=>{mess_done.style.opacity = '0'},2000)
			<?php } ?>
		</script>
			
			</div>
		</div>
	</div>	
		

	
</body>
</html>