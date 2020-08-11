<?php 
	include('./header.php');
	include('../another/connect.php');
?>
	

<div class="main">
<?php
	if(isset($_GET['id']) && FILTER_VAR($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
	{
		$id = $_GET['id'];
		$query_select = "SELECT tieu_de, link, sap_xep, status, the_loai FROM video WHERE id = {$id}";
		$execute_select_query = mysqli_query($connect, $query_select) or die("Error: " . mysql_error($connect));
		$num = mysqli_num_rows($execute_select_query);
		if($num == 1)
		{
			list($title, $link, $order, $status, $category_video) = mysqli_fetch_array($execute_select_query);
		}
		else{
			echo '<p style="color: red; font-weight: bold"> Video không tồn tại </p>';
		}
	}
	else{
		header('location: http://localhost/blog/php/list_video.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$errors = array();

		if(empty($_POST['title']))
		{
			$errors[] = 'title';
		}
		else{
			$title = $_POST['title'];
		}
		if(empty($_POST['link']))
		{
			$errors[] = 'link';
		}
		else{
			$link = $_POST['link'];
		}
		if(empty($_POST['order']))
		{
			$order = 0;
		}
		else{
			$order = $_POST['order'];
		}
		if(empty($_POST['category']))
		{
			$errors[] = 'category';
		}
		else{
			$category = $_POST['category'];
		}
		$status = $_POST['status'];
		

		if(empty($errors))
		{
			if(substr($link, 0, 4) != 'http' && substr($link, 0, 5) != 'https')
			{
				echo '<p style="color: red; font-weight: bold"> Link không đúng </p>';
			}
			else{
				$query_update = "UPDATE video SET tieu_de =  '{$title}', link = '{$link}', sap_xep = {$order}, status =  {$status}, the_loai = '{$category}' WHERE id = {$id}";
				$execute_query_update = mysqli_query($connect, $query_update) or die('Error: ' . mysqli_error($connect));
				if(mysqli_affected_rows($connect) == 1)
				{
					header('location: http://localhost/blog/php/list_video.php');
				}
				else
				{			
					header('location: http://localhost/blog/php/list_video.php');
				}
			}
		}
		else{
			echo '<p style="color: red; font-weight: bold"> Bạn cần nhập đầy đủ thông tin </p>';
		}

	}
?>


<div class="container-fruid">
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_video.php" style="color: #000"> Back </a>
	</div>
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<form action="" method="POST" role="form">
				<legend> <h2> Chỉnh sửa video: <?php if(isset($title)) echo $title; ?>  </h2> </legend>
			
				<div class="form-group">
					<label for=""> Tiêu đề </label>
					<input type="text" name="title" class="form-control" placeholder="Tiêu đề..." value="<?php if(isset($title)) echo $title; ?>" autocomplete="off" maxLength="50">
					<?php
						if(isset($errors) && in_array('title', $errors))
							echo  '<p style="color: red; font-weight: bold; margin-top: 10px;"> bạn cần nhập tiêu đề cho video </p>';
					?>
				</div>
				<div class="form-group">
					<label for=""> Link </label>
					<input type="text" name="link" class="form-control" value="<?php if(isset($link)) echo $link; ?>" autocomplete="off">
					<?php
						if(isset($errors) && in_array('link', $errors))
							echo  '<p style="color: red; font-weight: bold; margin-top: 10px;"> bạn cần nhập link cho video </p>';
					?>
				</div>
				<div class="form-group">
					<label for=""> Thứ tự </label>
					<input type="number" name="order" class="form-control" value="<?php if(isset($order)) echo $order;?>" autocomplete="off">
				</div>
				<div class="form-group">
					<label for=""> Trạng thái </label> <br />
					<label class="radio-inline" for="rd-status-show">
						<input type="radio" name="status" id="rd-status-show" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?> > 
						Hiển thị
					</label>
					<label class="radio-inline" for="rd-status-hidden">
						<input type="radio" name="status" value="0" id="rd-status-hidden" <?php if(isset($status) && $status == 0) echo 'checked' ?>> 
						Không hiển thị
					</label>
				</div>
				<div class="form-group">
					<label for=""> Thể loại </label>
					<select class="form-control sl-ct" name="category">
						<?php
							$query_category = "SELECT * FROM add_category";
							$execute_category = mysqli_query($connect, $query_category);
							$result_category = mysqli_num_rows($execute_category);
							if($result_category > 0)
							{
								while ($rows = mysqli_fetch_array($execute_category)) {
						?>
							<option value="<?php echo $rows['ten_danhmuc']; ?>"><?php echo $rows['ten_danhmuc']; ?> </option>

						<?php
								}
							}
						?>
					</select>
				</div>				
				<button type="submit" name="submit_video" class="btn btn-primary"> Lưu </button>
				<br /> <br />
			</form>
		</div>
	</div>
</div>

	