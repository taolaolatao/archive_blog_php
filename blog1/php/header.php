<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Trang Quản Trị </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.12.1.custom_base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/toolbar-master/jquery.toolbar.css">
	<link rel="stylesheet" type="text/css" href="../css/simptip-master/simptip.css">
	<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
	<script src="https://unpkg.com/ionicons@4.2.0/dist/ionicons.js"></script>
	<script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.12.1.custom_base/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/toolbar-master/jquery.toolbar.js"></script>
	<script type="text/javascript" src="../js/jvs.js"></script>
</head>
<body>
	<?php
		session_start();
	?>
	<div class="container">
		<header class="header-main">
			<div class="title-header">
				<h1> Welcome <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> </h1>
			</div>
			<div class="notifycation-header">
				<div class="profile-user">
					<i class="fa fa-user-circle"></i>
					<span id="name-user"> <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?> </span>
					<ion-icon name="arrow-dropdown"></ion-icon>
					<ul class="profile-user-menu">
						<li> <a href="./logout.php" id="bt-log-out"> Log out </a> </li>
					</ul>
				</div>
			</div>
		</header>

		<?php include('./sidebar.php'); ?>