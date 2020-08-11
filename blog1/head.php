<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Blog Cá nhân </title>
	<link href="https://fonts.googleapis.com/css?family=Wendy+One" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/animate.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<!-- <script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script> -->
</head>
<body>
	<?php
		include('./another/connect.php');
		include('./another/func.php');
	?>
	<a href="#" class="scrollTop"><span class="glyphicon glyphicon-triangle-top"></span></a>
	<div class="container-fruid bg">
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<a href="http://vhmblog.com/" id="page-main"> <span id="tt-blog"> Boomz !! </span> </a> 
					<hr style="opacity: 0.2" />
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
					<form action="" method="POST" name="frm_search">
						<div class="search-box text-center">
							<input type="text" id="txt-search" name="search" autofocus autocomplete="off">
							<i class="glyphicon glyphicon-search search-click"> </i>
						</div>
					</form>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<nav class="navbar-main">
						<?php
							menu();
						?>
					</nav>
				</div>	
			</div>