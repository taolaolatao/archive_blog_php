<?php
	require('../another/connect.php');
	require('../another/func.php');
	require('./header.php');
?>

<div class="main">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
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

			if($_FILES['file']['size'] == '')
			{
				echo '<p class="alert alert-danger"> Bạn chưa chọn hình ảnh </p>';
				$title = $_POST['title'];
				$description = $_POST['description'];
				$time = $_POST['time'];
				$date = $_POST['date'];
				$content = $_POST['content'];
			}
			elseif(($_FILES['file']['type'] != 'image/gif') && 
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
			}
			elseif(($_FILES['file']['type'] == 'video/mp4') && ($_FILES['file']['type'] == 'application/octet-stream'))
			{
				echo '<p class="alert alert-danger"> File Không đúng định dạng </p>';
				$title = $_POST['title'];
				$description = $_POST['description'];
				$time = $_POST['time'];
				$date = $_POST['date'];
				$content = $_POST['content'];
			}
			elseif($_FILES['file']['size'] > 2000000)
			{
				echo '<p class="alert alert-danger"> Kích thước ảnh phải nhỏ hơn 2MB </p>';
				$title = $_POST['title'];
				$description = $_POST['description'];
				$time = $_POST['time'];
				$date = $_POST['date'];
				$content = $_POST['content'];
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

				
				if(!empty($_POST['description']) && !empty($_POST['content']))
				{
					$tmp_img = $_FILES['file']['tmp_name'];
					move_uploaded_file($tmp_img, $link_img);


					$title = $_POST['title'];
					$description = $_POST['description'];
					$time = $_POST['time'];
					$date = $_POST['date'];
					$content = $_POST['content'];
					$status = $_POST['status'];


					$query_add_post = "INSERT INTO category_post(danh_muc, tieu_de, mo_ta, noi_dung, anh, ngay_dang, gio_dang, sap_xep, status) VALUES({$parent_id}, '{$title}', '{$description}', '{$content}', '{$link_img}', '{$date}', '{$time}', {$ordernum}, {$status})";
					$execute_add_post = mysqli_query($connect, $query_add_post) or die("Query: {$query_add_post} <br />" . ' Error: ' . mysqli_error($connect));
					if(mysqli_affected_rows($connect) == 1)
					{
						echo '<p class="alert alert-success"> Thêm bài viết thành công </p>';
						$title = '';
						$description = '';
						$content = '';
						$parent_id = 0;
						$time = $_POST['time'];
						$date = $_POST['date'];
						$link_img = '';
						$status = 1;
						$ordernum = null;
					}
					else{
						echo '<p class="alert alert-warning"> Thêm bài viết thất bại </p>';
					}
				}
				else{
					echo '<p class="alert alert-danger"> Bạn cần nhập đầy đủ! </p>';
				}
			}

		}
	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form method="POST" role="form" name="frm" enctype="multipart/form-data">
					<legend> <h2> Thêm mới bài viết </h2> </legend>
				
					<div class="form-group">
						<label> Danh mục bài viết </label>
						<select name="parent" class="form-control">
							<?php show_category(); ?>
						</select>
					</div>
					<div class="form-group">
						<label> Tiêu đề </label>
						<input type="text" name="title" class="form-control" placeholder="Title..." autocomplete="off" required value="<?php if(isset($title)) echo $title; ?>" />
					</div>
					<div class="form-group">
						<label> Mô tả </label>
						<textarea class="form-control" name="description" rows="5" maxlength="300" required><?php if(isset($description)) echo $description; ?></textarea>
					</div>
					<div class="form-group">
						<label> Nội dung </label>
						<textarea class="form-control" id="content_post" name="content" rows="5" required><?php if(isset($content)) echo $content; ?></textarea>
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
						<img width="200" height="200" id="img-upload" class="img-responsive thumbnail img-rounded" alt="Image - Upload" src="../images/admin/Optimized-J2teaM.bmp">
						<input type="file" name="file" id="file" class="inputFile file"> 
						<label for="file"> <i class="fa fa-upload"></i> Upload Image </label>
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

				
					<button type="submit" class="btn btn-primary btn-block"> Thêm mới bài viết </button>
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

	var now = new Date();
	var date = now.getFullYear() + '-' + ("0" + (now.getMonth() + 1)) + '-' + now.getDate(); // Get Current Date
	var currentDate = now.toISOString().slice(0,10); // Get Current Date 

	document.getElementById("date_post").valueAsDate = new Date(); // Get Current Date 

	var hour  = (now.getHours() < 10 ? '0' + now.getHours() : now.getHours());
	var min   = (now.getMinutes() < 10 ? '0' + now.getMinutes() : now.getMinutes());
	document.getElementById('time_post').defaultValue = hour + ':' + min;


	var input = document.querySelector('input[type="file"]#file');
	var img = document.getElementById('img-upload');
	input.onchange = (e) => {
		img.width = 200;
		img.src = window.URL.createObjectURL(e.target.files[0]);
	}
</script>