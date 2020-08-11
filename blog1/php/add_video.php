<?php 
	include('./header.php');
	include('../another/connect.php');
?>
	

<div class="main">
<?php
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
		if(empty($_POST['category']))
		{
			$errors[] = 'category';
		}
		else{
			$category = $_POST['category'];
		}
		$status = $_POST['status'];
		$order = 0;

		if(empty($errors))
		{
			if(substr($link, 0, 4) != 'http' && substr($link, 0, 5) != 'https')
			{
				echo '<p style="color: red; font-weight: bold"> Link không đúng </p>';
			}
			else{
				$query = "INSERT INTO video(tieu_de, link, sap_xep, status, the_loai) VALUES('{$title}', '{$link}', $order, $status, '{$category}')";
				$execute = mysqli_query($connect, $query) or die('Error: ' . mysqli_error($connect));
				if(mysqli_affected_rows($connect) == 1)
				{
					echo '<p style="color: green; font-weight: bold"> Thêm video thành công </p>';
					$title = '';
					$link = '';
					$order = null;
				}
				else
				{			
					echo  '<p style="color: red; font-weight: bold"> Thêm video thất bại </p>';
				}
			}
		}
		else{
			echo '<p style="color: red; font-weight: bold"> Bạn cần nhập đầy đủ thông tin </p>';
		}

	}
?>
<div class="container-fruid">
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<form action="" method="POST" role="form">
				<legend> <h2> Thêm mới video </h2> </legend>
			
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
					<input type="text" name="link" class="form-control" placeholder="Link..." value="<?php if(isset($link)) echo $link; ?>" autocomplete="off">
					<?php
						if(isset($errors) && in_array('link', $errors))
							echo  '<p style="color: red; font-weight: bold; margin-top: 10px;"> bạn cần nhập link cho video </p>';
					?>
				</div>
				<div class="form-group">
					<label for=""> Thứ tự </label>
					<input type="number" name="order" class="form-control" placeholder="Thứ tự..." value="<?php if(isset($order)) echo $order;?>" autocomplete="off">
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
				<button type="submit" name="submit_video" class="btn btn-primary btn-block"> Thêm </button>
			</form>
		</div>
	</div>
</div>

