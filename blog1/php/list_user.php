<?php
	require('./header.php');
	require('../another/connect.php');
?>

<div class="main">
	<div class="container-fruid">
		<div class="row">
			<legend> <h2> Danh Sách User </h2> </legend>
			<?php
				$query_list_user = "SELECT * FROM sign_up ORDER BY id ASC";
				$execute_list_user = mysqli_query($connect, $query_list_user);
				if(mysqli_num_rows($execute_list_user) > 0)
				{
					while($rows = mysqli_fetch_array($execute_list_user))
					{
			?>
				<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
					<div class="thumbnail">
						<img data-src="#" alt="">
						<div class="caption">
							<h3> <?php echo $rows['hoten']; ?></h3>
							<p>
								<div class="list-group">
									<li class="list-group-item active">
										<h4 class="list-group-item-heading">ID</h4>
										<p class="list-group-item-text"><?php echo $rows['id']; ?></p>
									</li>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">USERNAME</h4>
										<p class="list-group-item-text"><?php echo $rows['username']; ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">PASSWORD</h4>
										<p class="list-group-item-text"><?php if($rows['username'] == $_SESSION['username'] || $_SESSION['username'] == 'admin'){ echo base64_decode($rows['password']); } else if($rows['username'] <> $_SESSION['username'] && $_SESSION['username'] <> 'admin'){ echo base64_encode($rows['password']); } else{ echo base64_decode($rows['password']); } ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">HỌ TÊN</h4>
										<p class="list-group-item-text"><?php echo $rows['hoten']; ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">SỐ ĐIỆN THOẠI</h4>
										<p class="list-group-item-text"><?php echo $rows['sdt']; ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">EMAIL</h4>
										<p class="list-group-item-text"><?php echo $rows['email']; ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">ĐỊA CHỈ</h4>
										<p class="list-group-item-text"><?php echo $rows['dia_chi']; ?></p>
									</a>
									<a class="list-group-item">
										<h4 class="list-group-item-heading">TRẠNG THÁI</h4>
										<p class="list-group-item-text">
											<?php 
												if($rows['status'] == 1) echo 'Kích hoạt';
												else echo 'Vô hiệu hóa';
											?>		
										</p>
									</a>
								</div>
							</p>
							<p>
								<a href="./edit_user.php?id=<?php echo $rows['id']; ?>&user=<?php echo $rows['username']; ?>" class="btn btn-primary <?php if($_SESSION['username'] != 'admin' && $_SESSION['username'] != $rows['username']) echo 'disabled'; ?>"> Sửa </a>
								<a onclick="return confirm('Bạn có muốn xóa user @ <?php echo $rows['username']; ?> @ không? '); " href="./delete_user.php?id=<?php echo $rows['id']; ?>&user=<?php echo $rows['username']; ?>" class="btn btn-default <?php if($rows['username'] == $_SESSION['username']){ echo 'disabled'; } else if($_SESSION['username'] != 'admin'){ echo 'disabled'; } ?>"> Xóa </a>
							</p>
						</div>
					</div>
				</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</div>