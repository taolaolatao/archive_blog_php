<?php 
	include('./header.php'); 
	include('../another/connect.php');
?>

<div class="main">
	<h2> Danh sách thể loại </h2>
	<form method="POST" action="./delete_category.php" name="frm">
		<input type="submit" name="bt_del_all_category" id="bt-del-category-all"  value="Xóa All">
	</form>
	<table class="table table-hover table-category-list">
		<tr>
			<th> Id </th>
			<th> Tên thể loại </th>
			<th> Sửa </th>
			<th> Xóa </th>
		</tr>
		<?php
			$query_category_list = "SELECT * FROM add_category ORDER BY id ASC";
			$execute_category_query = mysqli_query($connect, $query_category_list) or die('Error: ' . mysqli_error($connect));
			while($rows = mysqli_fetch_array($execute_category_query))
			{
		?>
			<tr>
				<td> <?php echo $rows['id']; ?> </td>
				<td> <?php echo $rows['ten_danhmuc']; ?> </td>
				<td> <a class="a-edit-category-name" href="./edit_category.php?id=<?php echo $rows['id']; ?>" id="a-edit-category"> <i class="fa fa-pencil-square-o"></i> </a> </td>
				<td> <a onclick="return confirm('Bạn có muốn xóa không?');" href="./delete_category.php?id=<?php echo $rows['id']; ?>" id="a-del-category"> <i class="fa fa-trash"></i> </a> </td>
			</tr>
		<?php
			}
		?>
	</table>
	<strong> <a href="./admin.php" id="a-add-category"> Thêm danh mục </a> </strong>
</div>	

