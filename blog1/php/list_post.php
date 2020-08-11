<?php
	require('../another/connect.php');
	require('./header.php');
?>

<div class="main">
	<div class="container-fruid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<table class="table table-hover tb-list-post">
					<thead>
						<tr>
							<th> ID </th>
							<th> Danh mục bài viết </th>
							<th> Tiêu đề </th>
							<th> Ảnh </th>
							<th> Lượt xem </th>
							<th> Ngày đăng </th>
							<th> Giờ đăng </th>
							<th> Trạng thái </th>
							<th> Sửa </th>
							<th> Xóa </th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query_list_post = "SELECT * FROM category_post ORDER BY sap_xep ASC";
							$execute_list_post = mysqli_query($connect, $query_list_post);
							while ($posts = mysqli_fetch_array($execute_list_post)) {
						?>
							<tr>
								<td> <?php echo $posts['id']; ?> </td>
								<td> 
									<?php 
										$query_get_id_parent = "SELECT danhmuc_baiviet FROM menu WHERE ID = {$posts['danh_muc']}";
										$execute_get_id_parent = mysqli_query($connect, $query_get_id_parent);
										$result_get_id = mysqli_fetch_assoc($execute_get_id_parent);
										echo $result_get_id['danhmuc_baiviet'];
									?> 
								</td>
								<td width="190"> <?php echo $posts['tieu_de']; ?> </td>
								<td> <img width="100" src="<?php echo $posts['anh']; ?>"> </td>
								<td> <?php echo $posts['luot_xem']; ?> </td>
								<td> <?php echo $posts['ngay_dang']; ?> </td>
								<td> <?php echo $posts['gio_dang']; ?> </td>
								<td> 
									<?php  
										if($posts['status'] == 1) echo 'Hiển thị';
										else echo 'Không hiển thị';
									?> 
								</td>
								<td> <a href="./edit_post.php?id=<?php echo $posts['id']; ?>"> <i class="fa fa-pencil-square"></i> </a> </td>
								<td> <a onclick="return confirm('Bạn có muốn xóa không?');" href="./delete_post.php?id=<?php echo $posts['id']; ?>"> <i class="fa fa-trash-o"></i> </a> </td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>