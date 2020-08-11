<?php
	include('./header.php');
	include('../another/connect.php');
?>

<div class="main">
	<?php
		if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1)))
		{
			$id = $_GET['id'];
			$query_edit_category = "SELECT * FROM add_category WHERE id = {$id}";
			$execute_edit_category = mysqli_query($connect, $query_edit_category);
			if(mysqli_num_rows($execute_edit_category) == 1)
			{
				list($id_category, $name_category) = mysqli_fetch_array($execute_edit_category);
			}
			else{
				echo '<p style="color: red; font-weight: bold;"> ID không tồn tại! &Oslash; </p>';
			}
		}
		else{
			header('location: http://localhost/blog/php/list_category.php');
		}
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$errors = array();
			if(empty($_POST['edit_category_id']))	
			{
				$errors[] = 'id';
			}
			else{
				$id_edit = $_POST['edit_category_id'];
			}
			if(empty($_POST['edit_category_name']))
			{
				$errors[] = 'name';
			}
			else{
				$name_edit = $_POST['edit_category_name'];
			}
			if($errors)
			{
				echo '<p style="color: red; font-weight: bold;"> Bạn cần nhập đềy đủ info </p>';
			}
			else{	
				$query_check_id = "SELECT id FROM add_category WHERE {$id_edit} IN (SELECT id FROM add_category WHERE id != {$id_edit})";
				$execute_check_id = mysqli_query($connect, $query_check_id);
				$num = mysqli_num_rows($execute_check_id);

				if($num == 0)
				{
					$query_update_category = "UPDATE add_category SET id = {$id_edit}, ten_danhmuc = '{$name_edit}' WHERE id = $id";

					$execute_update_category = mysqli_query($connect, $query_update_category) or die(header('location: http://localhost/blog/php/list_category.php'));
					if(mysqli_affected_rows($connect) == 1)
					{
						header('location: http://localhost/blog/php/list_category.php');
						exit();
					}
					else{
						header('location: http://localhost/blog/php/list_category.php');
						exit();
					}
				}
				else{
					echo '<p style="color: red; font-weight: bold;"> ID bị trùng lặp </p>';
				}
			}
		}
	?>
	<div class="path-dashboard"> <!-- &frasl; &ensp; -->
		&lsaquo;
		<a href="./list_category.php" style="color: #000"> Back </a>
	</div>
	<div class="container-edit-category">
		<h4> Chỉnh sửa category: </h4>
		<form method="POST" action="#" name="frm" role="form">
			<table class="table-edit-category">
				<tr>	
					<td> ID: </td>
					<td> <input id="id_category" type="number" name="edit_category_id" value="<?php if(isset($id_category)) echo $id_category; ?>"> </td>
				</tr>
				<tr>
					<td> </td>
					<td>
						<p class="error_show" style="display: none; color: red; font-weight: bold; margin-bottom: 10px;"> ID Tồn tại </p>
					<?php
						if(isset($errors) && in_array('id', $errors))
						{
							echo '<p style="color: red; font-weight: bold; margin-bottom: 10px;"> Bạn cần nhập ID </p>';
						}
					?>
					<td>
				</tr>
				<tr>
					<td> Tên thể loại: </td>
					<td> <input type="text" name="edit_category_name" value="<?php if(isset($name_category)) echo $name_category; ?>"> </td>
				</tr>
				<tr>
					<td> </td>
					<td>
					<?php
						if(isset($errors) && in_array('name', $errors))
						{
							echo '<p style="color: red; font-weight: bold; margin-bottom: 5px;"> Bạn cần nhập tên thể loại </p>';
						}
					?>
					</td>
				</tr>
				<tr>
					<td> </td>
					<td> <input type="submit" name="submit_edit_category" value="Cập nhật"> </td>
				</tr>
			</table>
		</form>
	</div>
</div>
<script type="text/javascript">
	$('#id_category').blur(() => {
		var getId = $('#id_category').val();
		$.post('../another/ajax_id_category.php', { id : getId }, (data) => {
			if(data != 0)
			{
				$('.error_show').css('display', 'block');
			}
			else
			{
				$('.error_show').css('display', 'none');
			};
		});
	})
</script>