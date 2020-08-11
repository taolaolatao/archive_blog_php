<?php 
	include_once('./header.php');
	include_once('../another/connect.php');
	session_start(); 
	if(!isset($_SESSION['uid']))
	{
		header('location: ../login.php');
	}
?>

<div class="main">
	<?php 
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(!empty($_POST['category']))
			{
				$name_category = $_POST['category'];
				$query = "INSERT INTO add_category(ten_danhmuc) VALUES('$name_category')";
				$execute = mysqli_query($connect, $query) or die("Error: " . mysql_error($connect));
				if(mysqli_affected_rows($connect) == 1)
				{
					echo '<p style="color: green; font-weight: bold;"> Thêm danh mục thành công! </p>';
				}
				else{
					echo '<p style="color: red; font-weight: bold;"> Thêm danh mục thất bại </p>';
				}
			}
			else{
				echo '<p style="color: red; font-weight: bold;"> Bạn không được bỏ trống </p>';
			}
		}
	?>
	<h1> Thêm mới danh mục </h1>
	<hr />
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		<i class="fa fa-tachometer"></i> <a href="./admin.php"> Dashboard </a> &nbsp; &raquo; &nbsp; <a href="./list_category.php"> Quản lý danh mục </a> &nbsp; &raquo; &nbsp; Thêm mới
	</div>
	<div class="add-category-dashboard">
		<form method="POST" action="#" name="frm">
			<span> Tên danh mục &nbsp; </span>
			<input type="text" name="category" id="category" placeholder="Tên danh mục"> <br />
			<input type="submit" name="submit" id="bt-addCategory" value="Lưu">
		</form>
	</div>
</div>

<script type="text/javascript">
	$('#category').focus();
</script>