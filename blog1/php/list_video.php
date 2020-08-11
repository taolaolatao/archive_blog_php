<?php 
	include('./header.php'); 
	include('../another/connect.php');
?>

<div class="main">
	<h2> Danh sách video </h2>
	<form method="POST" action="./delete_video.php" name="frm">
		<input type="submit" name="bt_del_all_video" id="bt-del-video-all" value="Xóa All">
	</form>
	<div class="table-responsive">
		<table class="table table-hover table-list-video">
			<tr>
				<th> ID </th>
				<th> Tiêu đề </th>
				<th> Link </th>
				<th> Trạng thái </th>
				<th> Thể loại </th>
				<th> Sửa </th>
				<th> Xóa </th>
			</tr>
			<?php
				$total_recodes_one_page = 4;
				$query_all = "SELECT COUNT(id) FROM video";
				$execute_all = mysqli_query($connect, $query_all);
				list($records) = mysqli_fetch_array($execute_all, MYSQLI_NUM);
				$number_pages = ceil($records / $total_recodes_one_page);

				if(isset($_GET['index']))
				{
					$index = $_GET['index'];
					$one_page = ($index - 1) * $total_recodes_one_page;
					settype($index, 'int');
					$query_video_list = "SELECT * FROM video ORDER BY id ASC LIMIT $one_page, $total_recodes_one_page";
				}
				else{
					$query_video_list = "SELECT * FROM video ORDER BY id ASC LIMIT 0, $total_recodes_one_page";
				}


				
				$execute_video_query = mysqli_query($connect, $query_video_list) or die('Error: ' . mysqli_error($connect));
				while($rows = mysqli_fetch_array($execute_video_query))
				{
			?>
				<tr>
					<td> <?php echo $rows['id']; ?> </td>
					<td> <?php echo $rows['tieu_de']; ?> </td>
					<td> <?php echo $rows['link']; ?> </td>
					<td> 
						<?php 
							if($rows['status'] == 1) echo 'Hiển thị';
							else echo 'Không hiển thị';
						?> 
					</td>
					<td> <?php echo $rows['the_loai']; ?> </td>
					<td> <a href="./edit_video.php?id=<?php echo $rows['id']; ?>" id="a-edit-video"> <i class="fas fa-pencil-alt"></i> </a> </td>
					<td> <a onclick="return confirm('Bạn có muốn xóa video này không?');" href="./delete_video.php?id=<?php echo $rows['id']; ?>" id="a-del-video"> <i class="fa fa-trash"></i> </a> </td>
				</tr>
			<?php
				}
			?>
		</table>
		<ul class="pagination">
			<!-- <li><a href="#">&laquo;</a></li> -->
			<?php
				for ($i = 1; $i <= $number_pages; $i++) {
			?>
				<li> <a href='./list_video.php?index=<?php echo $i; ?>'> <?php echo $i; ?> </a>
			<?php
				}
			?>
			<!-- <li><a href="#">&raquo;</a></li> -->
		</ul>
	</div>
</div>