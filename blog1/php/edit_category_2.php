<?php
	require('../another/connect.php');
	require('./header.php');
	require('../another/func.php');
?>

<div class="main">
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_category_2.php" style="color: #000"> Back </a>
	</div>
	<?php
		if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
		{
			$id = $_GET['id'];
			$query_get_cate = "SELECT danhmuc_baiviet, parent_id, menu, home, ordernum, status FROM menu WHERE ID = {$id}";
			$execute_get_cate = mysqli_query($connect, $query_get_cate);
			if(mysqli_num_rows($execute_get_cate) == 1)
			{
				list($category_name, $parent_id, $status_menu, $status_home, $ordernum, $status) = mysqli_fetch_array($execute_get_cate);
			}
			else
			{
				header('location: ./list_category_2.php');
			}
		}
		else{
			echo '<p class="alert alert-danger"> ID không tồn tại </p>';
		}

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

			if($id != $parent_id)
			{
				$query_edit_category = "UPDATE menu SET danhmuc_baiviet = '{$category_name}', parent_id = {$parent_id}, menu = {$status_menu}, home = {$status_home}, ordernum = {$ordernum}, status = {$status} WHERE ID = {$id}";
				$execute_edit_category = mysqli_query($connect, $query_edit_category) or die("Query: $query_edit_category <br />" . 'Error: ' . mysqli_error($connect));;
				if(mysqli_affected_rows($connect) == 1)
				{
					echo '<p class="alert alert-success"> Sửa danh mục thành công <a href="./list_category_2.php" class="alert-link"> danh mục </a> </p>';
				}
				else{
					header('location: ./list_category_2.php', true);
				}
			}
			else
			{
				echo '<p class="alert alert-danger"> Sửa danh mục thất bại </p>';
			}
		}


	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form action="" method="POST" role="form">
					<legend> <h2> Sửa danh mục </h2> </legend>
				
					<div class="form-group">
						<label> Danh mục bài viết </label>
						<input type="text" class="form-control" name="category_name" placeholder="Danh mục bài viết..." value="<?php if(isset($category_name)) echo $category_name; ?>" required autocomplete="off">
					</div>

					<div class="form-group">
						<label> Danh mục cha </label>
						<select name="parent" class="form-control">
							<?php 
								if(isset($parent_id) && $parent_id != 0)
								{
									$query_select_parent = "SELECT ID, danhmuc_baiviet FROM menu WHERE ID = {$parent_id}";
									$execute_select_parent = mysqli_query($connect, $query_select_parent);
									$result = mysqli_fetch_assoc($execute_select_parent);
							?>
									<option value="<?php echo $result['ID']; ?>"> 
							<?php
									echo $result['danhmuc_baiviet'];
							?>
									</option>
									<option value="0"> <h3> Danh mục cha </h3> </option>
							<?php
								}
								else{
							?>
									<option value="0"> <h3> Danh mục cha </h3> </option>
							<?php
								}
							?>
							<?php show_category(); ?>
						</select>
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
						<input type="text" class="form-control" name="ordernum" autocomplete="off" placeholder="thứ tự..." value="<?php if(isset($ordernum)) echo $ordernum; ?>">
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
				
					<button type="submit" class="btn btn-primary btn-block"> Lưu </button>

				</form>
			</div>
		</div>
	</div>
	
	<br /><br />

</div>