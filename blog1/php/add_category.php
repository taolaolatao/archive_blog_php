<?php
	require('../another/connect.php');
	require('./header.php');
	require('../another/func.php');
?>

<div class="main">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$category_name = $_POST['category_name'];
			$status_menu = $_POST['status_menu'];
			$status_home = $_POST['status_home'];
			$status = $_POST['status'];

			if($_POST['parent'] == 0)
			{
				$parent_id = 0;
			}
			else{
				$parent_id = $_POST['parent'];
			}
			if(empty($_POST['ordernum']))
			{	
				$ordernum = 0;
			}
			else{
				$ordernum = $_POST['ordernum'];
			}

			$query_add_category = "INSERT INTO menu (danhmuc_baiviet, parent_id, menu, home, ordernum, status) VALUES('{$category_name}', {$parent_id}, {$status_menu}, {$status_home}, {$ordernum}, {$status})";
			$execute_add_category = mysqli_query($connect, $query_add_category) or die("Query: $query_add_category <br />" . 'Error: ' . mysqli_error($connect));;
			if(mysqli_affected_rows($connect) == 1)
			{
				echo '<p class="alert alert-success"> Thêm danh mục thành công <a href="./list_category_2.php" class="alert-link"> danh mục </a> </p>';
			}
			else{
				echo '<p class="alert alert-danger"> Thêm danh mục thất bại </p>';
			}
		}


	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form action="" method="POST" role="form">
					<legend> <h2> Thêm danh mục </h2> </legend>
				
					<div class="form-group">
						<label> Danh mục bài viết </label>
						<input type="text" class="form-control" name="category_name" placeholder="Danh mục bài viết..." required autocomplete="off">
					</div>

					<div class="form-group">
						<label> Danh mục cha </label>
						<?php select('parent', 'form-control'); ?>
					</div>
						

					<div class="form-group">
						<label> Hiển thị menu </label> <br />
						<div class="radio">
							<label for="rd-status-category-enable" class="radio-inline">
								<input type="radio" name="status_menu" id="rd-status-category-enable" value="1" checked <?php if(isset($status_menu) && $status_menu == 1) echo 'checked' ?>> Hiển thị
							</label>
							<label for="rd-status-category-disable" class="radio-inline">
								<input type="radio" name="status_menu" id="rd-status-category-disable" value="0" <?php if(isset($status_menu) && $status_menu == 0) echo 'checked' ?>> Không hiển thị
							</label>
						</div>
					</div>

					<div class="form-group">
						<label> Hiển thị home </label> <br />
						<div class="radio">
							<label for="rd-status-home-enable" class="radio-inline">
								<input type="radio" name="status_home" id="rd-status-home-enable" value="1" checked <?php if(isset($status_home) && $status_home == 1) echo 'checked' ?>> Hiển thị
							</label>
							<label for="rd-status-home-disable" class="radio-inline">
								<input type="radio" name="status_home" id="rd-status-home-disable" value="0" <?php if(isset($status_home) && $status_home == 0) echo 'checked' ?>> Không hiển thị
							</label>
						</div>
					</div>

					<div class="form-group">
						<label> Thứ tự </label>
						<input type="text" class="form-control" name="ordernum" autocomplete="off" placeholder="thứ tự...">
					</div>
					
					<div class="form-group">
						<label> Trạng thái </label> <br />
						<div class="radio">
							<label for="rd-status-show-enable" class="radio-inline">
								<input type="radio" name="status" id="rd-status-show-enable" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?>> Hiển thị
							</label>
							<label for="rd-status-hide-disable" class="radio-inline">
								<input type="radio" name="status" id="rd-status-hide-disable" value="0" <?php if(isset($status) && $status == 0) echo 'checked' ?>> Không hiển thị
							</label>
						</div>
					</div>
				
					<button type="submit" class="btn btn-primary btn-block"> Thêm mới </button>

				</form>
			</div>
		</div>
	</div>
	
	<br /><br />

</div>