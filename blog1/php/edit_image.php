<?php
	ob_start();
	include('./header.php');
	include('../another/connect.php');
?>

<div class="main">
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_image.php" style="color: #000"> Back </a>
	</div>
	<?php
		if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
		{
			$id = $_GET['id'];
			$query_img = "SELECT tieu_de, anh, link, sap_xep, status FROM image_post WHERE id = {$id}";
			$execute_img = mysqli_query($connect, $query_img);
			if(mysqli_num_rows($execute_img) == 1)
			{
				list($title, $link_img, $link, $order, $status) = mysqli_fetch_array($execute_img);
			}
		}
		else{
			echo '<p class="alert alert-danger"> ID không tồn tại </p>';
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
			if(empty($_POST['order']))
			{
				$order = 0;
			}
			else{
				$order = $_POST['order'];
			}
			if(empty($_POST['link']) || !empty($_POST['link']))
			{
				$link = $_POST['link'];
			}
			if(empty($_POST['status']) || !empty($_POST['status']))
			{
				$status = $_POST['status'];
			}


			if(empty($errors))
			{

				// Kiểm tra có phải link không
				if(!empty($link) && (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://'))
				{
					echo '<p class="alert alert-danger"> Link không đúng </p>';
				}
				// Nếu không úp ảnh mới thì lấy ảnh cũ update
				else{
					if ($_FILES['file']['size'] == '')
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
						}
						elseif(($_FILES['file']['type'] == 'video/mp4') && ($_FILES['file']['type'] == 'application/octet-stream'))
						{
							echo '<p class="alert alert-danger"> File Không đúng định dạng </p>';
						}
						elseif ($_FILES['file']['size'] > 2000000) {
							echo '<p class="alert alert-warning"> Kích thước ảnh phải nhỏ hơn 2MB </p>';
						}	
						else
						{
							// Random Chuỗi, cắt và lấy 5 ký tự //
							$md5 = md5(microtime());
							$randStr = substr($md5, 0, 5);

							$name_img = $_FILES['file']['name'];

							// Lấy độ dài của tên file //
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
							$query_del_img_old = "SELECT anh FROM image_post WHERE id = {$id}";
							$execute_del_img_old = mysqli_query($connect, $query_del_img_old);
							$result_img_old = mysqli_fetch_assoc($execute_del_img_old);
							unlink($result_img_old['anh']);
						}
					}
					$query_img_update = "UPDATE image_post SET tieu_de = '{$title}', anh = '{$link_img}', link = '{$link}', sap_xep = {$order}, status = {$status} WHERE id = {$id}";
					$execute_update_query = mysqli_query($connect, $query_img_update) or die("Query: {$query_img_upload} <br />" . ' Error: ' . mysqli_error($connect));
					if(mysqli_affected_rows($connect) == 1)
					{
						header('location: http://localhost/blog/php/list_image.php');
					}
					else
					{
						echo '<p title="Thông báo" id="dialog-message" class="alert alert-warning"> Có lỗi khi cập nhật ảnh! bạn có muốn tiếp tục? </p>';
					}
				}
			}
			else{
				echo '<p class="alert alert-danger"> Bạn cần nhập đầy đủ thông tin </p>';
			}
		} 
	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form action="" method="POST" role="form" enctype="multipart/form-data">
					<legend> <h2> Sửa hình ảnh:  <?php if(isset($title)) echo $title; ?> </h2> </legend>
				
					<div class="form-group">
						<label for="txtTitle"> Tiêu đề </label>
						<input type="text" name="title" class="form-control" id="txtTitle" placeholder="Tiêu đề..." value="<?php if(isset($title)) echo $title; ?>" autocomplete="off" maxLength="50">
						<?php
							if(isset($errors) && in_array('title', $errors))
							{
								echo  '<p style="color: red; font-weight: bold; font-size: 14px"> Bạn chưa nhập tiêu đề </p>';
							}
						?>
					</div>
					<div class="form-group">
						<label> Ảnh </label> <br />
						<img width="200" height="200" id="img-upload" class="img-responsive thumbnail img-rounded" alt="Image - Upload" src="<?php if(isset($link_img)) echo $link_img; ?>">
						<input type="hidden" name="img_old" value="<?php echo $link_img; ?>">
						<input type="file" name="file" id="file" class="inputFile file">
						<label for="file"> <i class="fa fa-upload"></i> Upload Image </label>
						<span style="display: block;" id="name_file_upload"> </span>
					</div>
					<div class="form-group">
						<label for="txtLink"> Link </label>
						<input type="text" name="link" class="form-control" id="txtLink" placeholder="Link..." value="<?php if(isset($link)) echo $link; ?>" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="txtOrder"> Thứ tự </label>
						<input type="number" name="order" class="form-control" id="txtOrder" placeholder="Thứ tự.." value="<?php if(isset($order)) echo $order;?>" autocomplete="off">
					</div>
					<div class="form-group">
						<label for=""> Trạng thái </label> <br />
						<label class="radio-inline" for="rd-status-show">
							<input type="radio" name="status" id="rd-status-show" value="1" checked <?php if(isset($status) && $status == 1) echo 'checked' ?>>Hiển thị
						</label>
						<label class="radio-inline" for="rd-status-hide">
							<input type="radio" name="status" id="rd-status-hide" value="0" id="rd-status-hidden" <?php if(isset($status) && $status == 0) echo 'checked' ?>>Không hiển thị
						</label>
					</div>

					<div class="form-group">
						<label> Thể loại </label>
						<select class="form-control sl-ct">
						<?php
							$query_category = "SELECT * FROM add_category";
							$execute_category_query = mysqli_query($connect, $query_category);
							if(mysqli_num_rows($execute_category_query) > 0)
							{
								while($rows = mysqli_fetch_array($execute_category_query))
								{
						?>
									<option value="<?php echo $rows['ten_danhmuc']; ?>"> <?php echo $rows['ten_danhmuc']; ?></option>
						<?php

								}
							}
						?>
					    </select>
					</div>
					
				
					<button type="submit" class="btn btn-primary"> Lưu </button>
					<br /> <br />
				</form>		
			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(() => {
		'use stricts';
		var input = document.querySelector('input[type="file"]#file');
		var img = document.getElementById('img-upload');
		var name_img_upload = document.getElementById('name_file_upload');

		(function changeIMG()
		{
			input.onchange = (e) => {
				img.width = 200;
				img.src = URL.createObjectURL(e.target.files[0]);
				// name_img_upload.innerHTML = input.value;
			}
		})();

		$("#dialog-message").dialog({
	      modal: true,
	      buttons: {
	        Yes: function() {
	          $(this).dialog( "close" );
	        },
	        No: function() {
	        	window.location.assign('http://localhost/blog/php/list_image.php');
	        }
	      }
	    });

	});
</script>
<?php ob_flush(); ?>