<?php
	include('./header.php');
	include('../another/connect.php');
?>
<div class="main">
	<div class="container-fruid">
		<div class="row">
			<legend> <h2> Danh sách hình ảnh </h2> </legend>
			<?php
				$query_list_img = "SELECT * FROM image_post";
				$execute_img_query = mysqli_query($connect, $query_list_img);
				if(mysqli_num_rows($execute_img_query) > 0)
				{
					while ($rows = mysqli_fetch_array($execute_img_query, MYSQLI_ASSOC)) {
			?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<div class="thumbnail">
								<img data-src="#" alt="">
								<div class="caption">
									<h4> <?php echo $rows['tieu_de']; ?></h4>
									<p>
										<span class="simptip-position-top simptip-smooth simptip-movable" data-tooltip="<?php if($rows['status'] == 1) echo 'Hiển thị'; else echo 'Không hiển thị'; ?>">
											<img  class="img-list thumbnail img-rounded" width="100%" height="230" src="<?php echo $rows['anh']; ?>">
										</span>
									</p>
									<p>
										<a href="./edit_image.php?id=<?php echo $rows['id']; ?>" class="btn btn-primary"> Sửa </a>
										<a onclick="return confirm('Bạn có muốn xóa ảnh không?');" href="./delete_image.php?id=<?php echo $rows['id']; ?>" class="btn btn-default"> Xóa </a>

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


<!--   : change tooltip's arrow to half arrow
.simptip-smooth : makes soft edge for tooltip
.simptip-fade : fades effect for show/hide
.simptip-movable : shows movable effect
.simptip-multiline : makes multiline body for tooltip
.simptip-success : changes color to green spectrum
.simptip-info : changes color to blue spectrum
.simptip-warning : changes color to orange spectrum
.simptip-danger : changes color to red spectrum -->