<?php

	include('./head.php');
	include('./slider.php');
	if(isset($_GET['dm']) && filter_var($_GET['dm'], FILTER_VALIDATE_INT, array('min_range' => 1)))
	{
		$dm = $_GET['dm'];
		$query_get_cate = "SELECT ID, danhmuc_baiviet FROM menu WHERE ID = {$dm}";
		$execute_get_cate = mysqli_query($connect, $query_get_cate) or die("Query: $query_get_cate <br />" . 'Error: ' . mysqli_error($connect));
		$result_cate = mysqli_fetch_assoc($execute_get_cate);
?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<div class="category-head">
					<h1> <small> &clubs; Thể loại: <?php echo $result_cate['danhmuc_baiviet']; ?> </small> </h1>
				</div>
				<?php
					$limit = 4;

					if(isset($_GET['index']) && filter_var($_GET['index'], FILTER_VALIDATE_INT, array('min_range' => 1)))
					{
						$page = $_GET['index'];
						$one_page = ($page - 1) * $limit;
						$query_get_post = "SELECT * FROM category_post WHERE danh_muc = {$dm} ORDER BY id DESC LIMIT {$one_page}, {$limit}";
					}
					else
					{
						$page = 0;
						$query_get_post = "SELECT * FROM category_post WHERE danh_muc = {$dm} ORDER BY id DESC LIMIT {$page}, {$limit}";
					}
					
					$execute_get_post = mysqli_query($connect, $query_get_post) or die("Query: $query_get_post <br />" . 'Error: ' . mysqli_error($connect));

					if(mysqli_num_rows($execute_get_post) > 0)
					{
						while($post_by_cate = mysqli_fetch_array($execute_get_post)){

				?>
						<article>
							<div class="row row-post">
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<img class="img-responsive"  src="<?php 
										$src = $post_by_cate['anh'];
											echo substr($src, 1, strlen($src) - 1);
									?>">
								</div>
								<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<h3 class="media-heading"> 
										<a href="./detail_post.php?id=<?php echo $post_by_cate['id']; ?>&dm=<?php echo $post_by_cate['danh_muc']; ?>"> <?php echo $post_by_cate['tieu_de']; ?> </a> 
									</h3>
									<p>
										<details>
											<small>
												<time><?php echo $post_by_cate['ngay_dang']; ?></time>
												&nbsp;<time><?php echo $post_by_cate['gio_dang']; ?></time>
											</small>
										</details>
									</p>
									<p>
										<small>
											<figcaption class="description">
												<?php echo $post_by_cate['mo_ta']; ?>
											</figcaption>
										</small>
									</p>
								</div>
							</div> 
						</article>
				<?php
						}
					}
			if(mysqli_num_rows($execute_get_post) > 0)
			{
				$get_post_total = mysqli_query($connect, "SELECT * FROM category_post WHERE danh_muc = {$dm}");
				$num = mysqli_num_rows($get_post_total);
				$number_page = ceil($num / $limit);
				if($number_page != 1)
				{
				?>
				
				<ul class="pagination">
					<li class="previous" style="<?php if(!isset($_GET['index']) or $_GET['index'] == 1) echo 'display: none';  ?>">
						<a href="./post_by_category.php?index=<?php if(isset($_GET['index']) && $_GET['index'] > 0) $previous = $_GET['index']; echo --$previous; ?>&dm=<?php echo $dm; ?>">Previous</a>
					</li>
					<?php
						
						for ($i = 1; $i <= $number_page; $i++) {
							$count = $i;
					?>
							<li class="<?php if(!isset($_GET['index']) && $i == 1) echo 'active'; ?>">
								<a href="./post_by_category.php?index=<?php echo $i; ?>&dm=<?php echo $dm; ?>">
									<?php echo $i; ?>	
								</a>
							</li>
					<?php
						}
					?>
					
					<li class="next" style="<?php if($_GET['index'] == $number_page || $count == 1) echo 'display: none'; ?>">
						<a href="./post_by_category.php?index=<?php if(!isset($_GET['index'])){echo 2;}elseif(isset($_GET['index'])){$next = $_GET['index']; echo ++$next;} ?>&dm=<?php echo $dm; ?>">Next</a>
					</li>
				</ul>
			<?php
				}
			}
			?>
			</div>
			<script type="text/javascript">
				<?php
					if (isset($_GET['index'])) {
						$active = $_GET['index'];
				?>
						$('ul.pagination li:nth-child(' + <?php echo (++$active); ?> + ')').addClass('active');
				<?php
					}
				?>
			</script>
<?php
		include('./right.php');
	}
	else{
		header('location: ./index.php');
		exit();
	}

?>