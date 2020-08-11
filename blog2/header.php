<?php include('inc/config.php') ?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Responsive</title>

	<?php include('inc/fw.php') ?>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="<?= BASE_URL ?>">Website</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02">
			    <ul class="navbar-nav mr-auto">
				    <li class="nav-item active">
				        <a class="nav-link" href="<?= BASE_URL ?>">Home <span class="sr-only">(current)</span></a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="admin/insert.php">Admin</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="#">Pricing</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link" href="#">About</a>
				    </li>
			    </ul>
			    <form class="form-inline my-2 my-lg-0">
			      	<input class="form-control mr-sm-2" type="text" placeholder="Search">
			      	<button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
			    </form>
			</div>
		</div>
	</nav>