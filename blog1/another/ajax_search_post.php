<?php
	require('../another/connect.php');
	$title = $_POST['title'];
	$query_getpost_bykeyword = "SELECT * FROM category_post WHERE tieu_de LIKE '%$title%'";
	$execute_query_getpost = mysqli_query($connect, $query_getpost_bykeyword);
	$result_num = mysqli_num_rows($execute_query_getpost);
	if($result_num > 0)
	{
		while ($result = mysqli_fetch_array($execute_query_getpost)) {
?>
	<article>
		<div class="row row-post">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<img class="img-responsive"  src="<?php 
					$src = $result['anh'];
						echo substr($src, 1, strlen($src) - 1);
				?>">
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<h3 class="media-heading"> 
					<a href="./detail_post.php?id=<?php echo $result['id']; ?>&dm=<?php echo $result['danh_muc']; ?>"> <?php echo $result['tieu_de']; ?> </a> 
				</h3>
				<p>
					<details>
						<small>
							<time><?php echo $result['ngay_dang']; ?></time>
							&nbsp;<time><?php echo $result['gio_dang']; ?></time>
						</small>
					</details>
				</p>
				<p>
					<small>
						<figcaption class="description">
							<?php echo $result['mo_ta']; ?>
						</figcaption>
					</small>
				</p>
			</div>
		</div> 
	</article>
<?php
		}
	}
	else
	{
		echo '<p class="alert alert-danger"> Not Found </p>';
	}
?>