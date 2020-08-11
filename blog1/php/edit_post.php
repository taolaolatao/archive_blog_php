<?php
	require('../another/connect.php');
	require('../another/func.php');
	require('./header.php');
?>

<div class="main">
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_post.php" style="color: #000"> Back </a>
	</div>
	<?php
		if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
		{
			$id = $_GET['id'];
			$query_get_post = "SELECT danh_muc, tieu_de, mo_ta, noi_dung, anh, ngay_dang, gio_dang, sap_xep, status FROM category_post WHERE id = {$id}";
			$execute_get_post = mysqli_query($connect, $query_get_post);
			if(mysqli_num_rows($execute_get_post) == 1)
			{
				list($danh_muc, $title, $description, $content, $link_img, $date, $time, $ordernum, $status) = mysqli_fetch_array($execute_get_post);
			}
			else{
				echo '<p class="alert alert-warning"> ID không tồn tại </p> ';
			}
		}
		else{
			header('location: ./list_post.php');
		}

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(empty($_POST['ordernum']))
			{
				$ordernum = 0;
			}
			else{
				$ordernum = $_POST['ordernum'];
			}

			if($_FILES['file']['size'] == '')
			{
				$link_img = $_POST['img_old'];
			}
			else{
				if(($_FILES['file']['type'] != 'image/gif') && 
						($_FILES['file']['type'] != 'image/png') && 
						($_FILES['file']['type'] != 'image/jpg') && 
						($_FILES['file']['type'] != 'image/jpeg') && 
						($_FILES['file']['type'] != 'image/bmp'))
				{
					echo '<p class="alert alert-danger"> File Không đúng định dạng </p>';
					$title = $_POST['title'];
					$description = $_POST['description'];
					$time = $_POST['time'];
					$date = $_POST['date'];
					$content = $_POST['content'];
					$danh_muc = $_POST['parent'];
				}
				elseif(($_FILES['file']['type'] == 'video/mp4') && ($_FILES['file']['type'] == 'application/octet-stream'))
				{
					echo '<p class="alert alert-danger"> File Không đúng định dạng </p>';
					$title = $_POST['title'];
					$description = $_POST['description'];
					$time = $_POST['time'];
					$date = $_POST['date'];
					$content = $_POST['content'];
					$danh_muc = $_POST['parent'];
				}
				elseif($_FILES['file']['size'] > 2000000)
				{
					echo '<p class="alert alert-danger"> Kích thước ảnh phải nhỏ hơn 2MB </p>';
					$title = $_POST['title'];
					$description = $_POST['description'];
					$time = $_POST['time'];
					$date = $_POST['date'];
					$content = $_POST['content'];
					$danh_muc = $_POST['parent'];
				}
				else{
					$md5 = md5(microtime());
					$randStr = substr($md5, 0, 5);

					$name_img = $_FILES['file']['name'];

					// Lấy độ dài của tên file
					$len_name_img = strlen($name_img);

					if($len_name_img >= 35)
					{
						// Cắt độ dài tên file xuống còn tối đa 35 ký tự //
						$name_extension = $_FILES['file']['type'];
						$str_get = strstr($name_extension , '/');
						$str_extension = substr($str_get, 1, strlen($str_get) - 1);
						$cut_str = substr($name_img, 0, 30) . '.' . $str_extension;
						$link_img = '../upload/images/' . $randStr . $cut_str;
					}
					else{
						$link_img = '../upload/images/' . $randStr . $name_img;
					}

					
					$tmp_img = $_FILES['file']['tmp_name'];
					move_uploaded_file($tmp_img, $link_img);

					// Xóa ảnh cũ
					$query_del_img_old = "SELECT anh FROM category_post WHERE id = {$id}";
					$execute_del_img_old = mysqli_query($connect, $query_del_img_old);
					$result_img_old = mysqli_fetch_assoc($execute_del_img_old);
					unlink($result_img_old['anh']);
				}
			}
			$title = $_POST['title'];
			$description = $_POST['description'];
			$time = $_POST['time'];
			$date = $_POST['date'];
			$content = $_POST['content'];
			$status = $_POST['status'];
			$danh_muc = $_POST['parent'];

			$query_update_post = "UPDATE category_post SET danh_muc = {$danh_muc}, tieu_de = '{$title}', mo_ta = '{$description}', noi_dung = '{$content}', anh = '{$link_img}', ngay_dang = '{$date}', gio_dang = '{$time}', sap_xep = {$ordernum}, status = {$status} WHERE id = {$id}";
			$execute_update_post = mysqli_query($connect, $query_update_post) or die("Query: {$query_update_post} <br />" . ' Error: ' . mysqli_error($connect));

			if(mysqli_affected_rows($connect) == 1)
			{
				echo '<p class="alert alert-success"> Sửa bài viết thành công </p>';
				$title = '';
				$description = '';
				$content = '';
				$time = $_POST['time'];
				$date = $_POST['date'];
				$link_img = '';
				$status = 1;
				$ordernum = null;
			}
			else{
				header('location: ./list_post.php');
			}
		}
	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form method="POST" role="form" name="frm" enctype="multipart/form-data">
					<legend> <h2> Sửa bài viết </h2> </legend>
				
					<div class="form-group">
						<label> Danh mục bài viết </label>
						<select name="parent" class="form-control">
							<option value="<?php if(isset($danh_muc)) echo $danh_muc; ?>"> 
								<?php 
									$query_get_id = "SELECT danhmuc_baiviet FROM menu WHERE ID = {$danh_muc}";
									$execute_get_id = mysqli_query($connect, $query_get_id);
									$result_get_id = mysqli_fetch_assoc($execute_get_id);
									echo $result_get_id['danhmuc_baiviet'];
								?> 
							</option>
							<?php 
								show_category(); 
							?>
						</select>
					</div>
					<div class="form-group">
						<label> Tiêu đề </label>
						<input type="text" name="title" class="form-control" placeholder="Title..." autocomplete="off" required value="<?php if(isset($title)) echo $title; ?>" />
					</div>
					<div class="form-group">
						<label> Mô tả </label>
						<textarea class="form-control" name="description" rows="5" maxlength="300" required>
							<?php if(isset($description)) echo trim($description); ?>
						</textarea>
					</div>
					<div class="form-group">
						<label> Nội dung </label>
						<textarea class="form-control" id="content_post" name="content" rows="5" required> 
							<?php if(isset($content)) echo $content; ?>
						</textarea>
					</div>
					<div class="form-group">
						<label> Ngày đăng </label>
						<input type="date" id="date_post" name="date" value="<?php if(isset($date)) echo $date; ?>" class="form-control" required />
					</div>
					<div class="form-group">
						<label> Giờ đăng </label>
						<input type="time" id="time_post" name="time" value="<?php if(isset($time)) echo $time; ?>" class="form-control" required />
					</div>

					<div class="form-group">
						<label> Thứ tự </label>
						<input type="number" class="form-control" name="ordernum" placeholder="Thứ tự...." autocomplete="off" value="<?php if(isset($ordernum)) echo $ordernum; ?>">
					</div>

					<div class="form-group">
						<label> Ảnh Thumbnail </label>
						<img width="200" height="200" id="img-upload" class="img-responsive thumbnail img-rounded" alt="Image - Upload" src="<?php if(isset($link_img)) echo $link_img; ?>">
						<input type="file" name="file" id="file" class="inputFile file"> 
						<label for="file"> <i class="fa fa-upload"></i> Upload Image </label>
						<input type="hidden" name="img_old" value="<?php echo $link_img; ?>">
					</div>

					<div class="form-group">
						<label> Trạng thái </label> <br />
						<label class="radio-inline" for="rd-status-show">
							<input type="radio" name="status" id="rd-status-show" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?> />Hiển thị
						</label>
						<label class="radio-inline" for="rd-status-hide">
							<input type="radio" name="status" id="rd-status-hide" value="0" id="rd-status-hidden" <?php if(isset($status) && $status == 0) echo 'checked' ?> />Không hiển thị
						</label>
					</div>

				
					<button type="submit" class="btn btn-primary btn-block"> Lưu bài viết </button>
					<br /> <br />
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../js/ckfinder/ckfinder.js"></script>

<script type="text/javascript">
	CKEDITOR.replace('content_post');
	CKEDITOR.addCss('textarea{display:block}');
	CKEDITOR.addCss('textarea{border:solid 1px red !important}');

	var input = document.querySelector('input[type="file"]#file');
	var img = document.getElementById('img-upload');
	input.onchange = (e) => {
		img.width = 200;
		img.src = window.URL.createObjectURL(e.target.files[0]);
	}
</script>