<?php
	include('./header.php');
	include('../another/connect.php');
?>

<div class="main">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['upload'] == $_POST['hidden_upload'])
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
				if(!empty($link) && (substr($link, 0, 7) != 'http://' && substr($link, 0, 8) != 'https://'))
				{
					echo '<p class="alert alert-danger"> Link không đúng </p>';
				}
				else{
					if ($_FILES['file']['size'] == '')
					{
						echo '<p class="alert alert-danger"> Bạn chưa chọn hình ảnh </p>';
					}
					elseif(($_FILES['file']['type'] != 'image/gif') && 
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

						$query_img_upload = "INSERT INTO image_post(tieu_de, anh, link, sap_xep, status) VALUES('{$title}', '{$link_img}', '${link}', $order, $status)";
						$execute_upload_query = mysqli_query($connect, $query_img_upload) or die("Query: {$query_img_upload} <br />" . ' Error: ' . mysqli_error($connect));
						if(mysqli_affected_rows($connect) == 1)
						{
							echo '<p class="alert alert-success"> Thêm ảnh thành công </p>';
							$title = '';
							$link = '';
							$link_img = '';
							$order = null;
						}
						else
						{			
							echo '<p class="alert alert-success"> Thêm hình ảnh thất bại </p>';
						}
					}	
				}
			}
			else{
				echo '<p class="alert alert-danger"> Bạn cần nhập đầy đủ thông tin </p>';
			}
		} 
		$rand = md5(microtime());
		$_SESSION['upload'] = $rand;
	?>
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<form action="" method="POST" role="form" enctype="multipart/form-data">
					<legend> <h2> Thêm hình ảnh </h2> </legend>
				
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
						<img width="200" height="200" id="img-upload" class="img-responsive thumbnail img-rounded" alt="Image - Upload" src="../images/admin/Optimized-J2teaM.bmp">
						<input type="file" name="file" id="file" class="inputFile file"> 
						<label for="file"> <i class="fa fa-upload"></i> Upload Image </label>
						<input type="hidden" name="hidden_upload" value="<?php echo $rand; ?>">
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
						<label> Trạng thái </label> <br />
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
					
				
					<button type="submit" name="submit" class="btn btn-primary btn-block"> Thêm mới </button>
					<br /> <br />
				</form>		
			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
	var input = document.querySelector('input[type="file"]#file');
	var img = document.getElementById('img-upload');
	var name_img_upload = document.getElementById('name_file_upload');

	input.onchange = (e) => {
		img.width = 200;
		img.src = URL.createObjectURL(e.target.files[0]);
		// name_img_upload.innerHTML = input.value;
	}
</script>